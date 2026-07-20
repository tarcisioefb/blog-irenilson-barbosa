<?php
namespace IrenilsonBarbosa\Core {

class AdminSettings {
	public static function init() {
		add_action('admin_menu', [__CLASS__, 'register_menus']);
		add_action('admin_init', [__CLASS__, 'register_settings']);
		add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
		add_action('wp_head', [__CLASS__, 'output_google_analytics'], 0);
	}

	public static function defaults() {
		return [
			'social_facebook'  => '',
			'social_instagram' => '',
			'social_youtube'   => '',
			'footer_tagline'   => 'Professor universitário, escritor e pesquisador.',
			'footer_about'     => 'Doutor em Educação pela UFBA. Autor de ensaios sobre filosofia, educação, política e cultura.',
			'sidebar_bio'      => 'Professor universitário, escritor e pesquisador. Doutor em Educação, autor de ensaios sobre filosofia, política, educação e cultura.',
			'site_logo'        => '',
			'font_heading'     => 'Literata',
			'font_body'        => 'Inter',
			'facebook_app_id'  => '',
			'home_cats'        => [],
			'banner_image'        => '',
			'banner_image_tablet' => '',
			'banner_image_mobile' => '',
			'banner_link'         => '',
			'google_analytics_id' => '',
		];
	}

	public static function opts() {
		static $o = null;
		if (null === $o) {
			$o = wp_parse_args((array) get_option('ib_opts', []), self::defaults());
		}
		return $o;
	}

	public static function opt($key) {
		$o = self::opts();
		return $o[$key] ?? '';
	}

	public static function register_menus() {
		add_menu_page(
			'Central do Site',
			'Central do Site',
			'manage_options',
			'ib-ajustes',
			[__CLASS__, 'render_page'],
			'dashicons-admin-site-alt3',
			3
		);

		add_submenu_page(
			'ib-ajustes',
			'Newsletter — Assinantes',
			'Newsletter',
			'manage_options',
			'ib-newsletter',
			[__CLASS__, 'render_newsletter']
		);
	}

	public static function register_settings() {
		register_setting('ib_group', 'ib_opts', [
			'type'              => 'array',
			'sanitize_callback' => [__CLASS__, 'sanitize'],
			'default'           => self::defaults(),
		]);
	}

	public static function sanitize($in) {
		$in  = is_array($in) ? $in : [];
		$out = [];
		foreach (['social_facebook', 'social_instagram', 'social_youtube'] as $k) {
			$out[$k] = isset($in[$k]) ? esc_url_raw(trim($in[$k])) : '';
		}
		$out['footer_tagline'] = isset($in['footer_tagline']) ? sanitize_text_field($in['footer_tagline']) : '';
		$out['footer_about']   = isset($in['footer_about']) ? sanitize_textarea_field($in['footer_about']) : '';
		$out['sidebar_bio']    = isset($in['sidebar_bio']) ? sanitize_textarea_field($in['sidebar_bio']) : '';
		$allowed_heading = ['Literata', 'Merriweather', 'Playfair+Display', 'Lora', 'PT+Serif', 'Source+Serif+4', 'Cormorant', 'Cormorant+Upright', 'Red+Hat+Display', 'Fraunces', 'Epilogue', 'Georgia', 'System'];
		$out['site_logo'] = isset($in['site_logo']) ? esc_url_raw(trim($in['site_logo'])) : '';
		$out['font_heading'] = in_array($in['font_heading'] ?? '', $allowed_heading, true) ? $in['font_heading'] : 'Literata';
		$allowed_body = ['Inter', 'Source+Sans+3', 'Nunito', 'Work+Sans', 'DM+Sans', 'System'];
		$out['font_body'] = in_array($in['font_body'] ?? '', $allowed_body, true) ? $in['font_body'] : 'Inter';
		$out['facebook_app_id'] = isset($in['facebook_app_id']) ? sanitize_text_field(trim($in['facebook_app_id'])) : '';
		$out['home_cats'] = [];
		if (isset($in['home_cats']) && is_array($in['home_cats'])) {
			$out['home_cats'] = array_values(array_filter(
				array_map('sanitize_text_field', $in['home_cats']),
				fn($v) => $v !== '_disabled_'
			));
		}
		$out['banner_image'] = isset($in['banner_image']) ? esc_url_raw(trim($in['banner_image'])) : '';
		$out['banner_image_tablet'] = isset($in['banner_image_tablet']) ? esc_url_raw(trim($in['banner_image_tablet'])) : '';
		$out['banner_image_mobile'] = isset($in['banner_image_mobile']) ? esc_url_raw(trim($in['banner_image_mobile'])) : '';
		$out['banner_link'] = isset($in['banner_link']) ? esc_url_raw(trim($in['banner_link'])) : '';
		$out['google_analytics_id'] = isset($in['google_analytics_id']) ? sanitize_text_field(trim($in['google_analytics_id'])) : '';
		return $out;
	}

	public static function enqueue_assets($hook) {
		if ('toplevel_page_ib-ajustes' !== $hook) return;
		wp_enqueue_media();
		$theme_uri = get_template_directory_uri();
		wp_enqueue_script('ib-admin', $theme_uri . '/assets/ib-admin.js', ['jquery'], IRENILSON_CORE_VERSION, true);
		wp_enqueue_script('jquery-ui-sortable');
	}

	public static function output_google_analytics() {
		$ga_id = self::opt('google_analytics_id');
		if (!$ga_id) return;
		?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
<script>
window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);}
gtag('js', new Date()); gtag('config', '<?php echo esc_js($ga_id); ?>');
</script>
		<?php
	}

	public static function render_page() {
		if (!current_user_can('manage_options')) return;
		$tab = $_GET['tab'] ?? 'geral';
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px">
				<span class="dashicons dashicons-admin-site-alt3" style="font-size:32px;width:32px;height:32px"></span>
				Central do Site — Irenilson Barbosa
			</h1>

			<?php if (isset($_GET['settings-updated'])) : ?>
				<div class="notice notice-success is-dismissible"><p>Alteracoes salvas.</p></div>
			<?php endif; ?>

			<nav class="nav-tab-wrapper" style="margin-bottom:20px">
				<a href="?page=ib-ajustes&amp;tab=geral" class="nav-tab <?php echo $tab === 'geral' ? 'nav-tab-active' : ''; ?>">Geral</a>
				<a href="?page=ib-ajustes&amp;tab=home" class="nav-tab <?php echo $tab === 'home' ? 'nav-tab-active' : ''; ?>">Home</a>
				<a href="?page=ib-ajustes&amp;tab=conteudo" class="nav-tab <?php echo $tab === 'conteudo' ? 'nav-tab-active' : ''; ?>">Conteudo</a>
				<a href="?page=ib-ajustes&amp;tab=aparencia" class="nav-tab <?php echo $tab === 'aparencia' ? 'nav-tab-active' : ''; ?>">Aparencia</a>
			</nav>

			<form method="post" action="options.php">
				<?php settings_fields('ib_group'); ?>

				<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
				<?php if ($tab === 'geral') : ?>
					<?php self::render_tab_geral(); ?>
				<?php elseif ($tab === 'home') : ?>
					<?php self::render_tab_home(); ?>
				<?php elseif ($tab === 'conteudo') : ?>
					<?php self::render_tab_conteudo(); ?>
				<?php elseif ($tab === 'aparencia') : ?>
					<?php self::render_tab_aparencia(); ?>
				<?php endif; ?>
				</div>

				<div style="margin-top:4px">
				<?php submit_button('Salvar alteracoes', 'primary', 'submit', true, ['style' => 'background:#3E2C1B;border-color:#3E2C1B;border-radius:4px;padding:8px 28px;height:auto;font-size:14px']); ?>
				</div>
			</form>
		</div>
		<?php
	}

	private static function card_open($icon, $title, $desc = '') {
		?>
		<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px;margin-bottom:20px">
			<h2 style="margin:0 0 4px;font-size:15px;color:#3E2C1B"><?php echo $icon; ?> <?php echo esc_html($title); ?></h2>
			<?php if ($desc) : ?><p style="margin:0 0 16px;color:#6D5940;font-size:12px"><?php echo esc_html($desc); ?></p><?php endif; ?>
		<?php
	}

	private static function card_close() {
		?></div><?php
	}

	private static function card_table_open() {
		?><table class="form-table" role="presentation" style="margin:0"><tbody><?php
	}

	private static function card_table_close() {
		?></tbody></table><?php
	}

	private static function render_tab_geral() {
		?>
		<div>
		<?php
		self::card_open('🔗', 'Redes sociais', 'Aparecem no topo do site.');
		self::card_table_open();
		foreach (['social_facebook' => 'Facebook', 'social_instagram' => 'Instagram', 'social_youtube' => 'YouTube'] as $k => $lbl) : ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0"><label for="<?php echo esc_attr($k); ?>" style="color:#3E2C1B;font-weight:600;font-size:12px"><?php echo esc_html($lbl); ?></label></th>
				<td style="padding:6px 0"><input type="url" id="<?php echo esc_attr($k); ?>" name="ib_opts[<?php echo esc_attr($k); ?>]" value="<?php echo esc_attr(self::opt($k)); ?>" class="regular-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
			</tr>
		<?php endforeach;
		self::card_table_close();
		self::card_close();

		self::card_open('🖼️', 'Logo', 'Usado no cabecalho e rodape. PNG ou SVG, largura max. 240px.');
		self::card_table_open();
		$logo_val = self::opt('site_logo'); ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0"><label for="site_logo" style="color:#3E2C1B;font-weight:600;font-size:12px">Logo</label></th>
				<td style="padding:6px 0">
					<div style="display:flex;gap:6px;flex-wrap:wrap">
						<input type="url" id="site_logo" name="ib_opts[site_logo]" value="<?php echo esc_attr($logo_val); ?>" class="regular-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px;flex:1;min-width:140px">
						<button type="button" class="button" data-media-pick="site_logo">Selecionar</button>
						<button type="button" class="button" data-media-clear="site_logo">Remover</button>
					</div>
					<?php if ($logo_val) : ?>
						<br><img id="preview-site_logo" src="<?php echo esc_url($logo_val); ?>" alt="" style="max-width:160px;height:auto;margin-top:6px;border:1px solid #dcdcde;border-radius:4px">
					<?php else : ?>
						<br><img id="preview-site_logo" alt="" style="display:none;max-width:160px;height:auto;margin-top:6px;border:1px solid #dcdcde;border-radius:4px">
					<?php endif; ?>
				</td>
			</tr>
		<?php
		self::card_table_close();
		self::card_close();
		?>
		</div>
		<div>
		<?php
		self::card_open('📊', 'Google Analytics', 'Insira o ID de medicao (ex.: G-XXXXXXXXXX) para ativar o Google Analytics 4.');
		self::card_table_open(); ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0"><label for="google_analytics_id" style="color:#3E2C1B;font-weight:600;font-size:12px">GA4 ID</label></th>
				<td style="padding:6px 0"><input type="text" id="google_analytics_id" name="ib_opts[google_analytics_id]" value="<?php echo esc_attr(self::opt('google_analytics_id')); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" style="border-color:#e0d5c3;border-radius:4px"></td>
			</tr>
		<?php
		self::card_table_close();
		self::card_close();

		self::card_open('💬', 'Comentarios do Facebook');
		self::card_table_open(); ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0"><label for="facebook_app_id" style="color:#3E2C1B;font-weight:600;font-size:12px">App ID</label></th>
				<td style="padding:6px 0"><input type="text" id="facebook_app_id" name="ib_opts[facebook_app_id]" value="<?php echo esc_attr(self::opt('facebook_app_id')); ?>" class="regular-text" placeholder="1234567890" style="border-color:#e0d5c3;border-radius:4px"></td>
			</tr>
		<?php
		self::card_table_close();
		self::card_close();
		?>
		</div>
		<?php
	}

	private static function render_tab_home() {
		?>
		<div>
		<?php
		self::card_open('🏠', 'Categorias em destaque', 'Arraste para reordenar. Desmarque para ocultar da home.'); ?>
			<ul id="ib-home-cats" style="margin:0;padding:0;list-style:none">
				<?php
				$saved = self::opt('home_cats');
				$saved = is_array($saved) ? $saved : [];
				$all_terms = get_terms(['taxonomy' => 'category', 'hide_empty' => false, 'fields' => 'all']);
				$all_terms = array_filter($all_terms, fn($t) => 'uncategorized' !== $t->slug);
				$ordered = [];
				if (!empty($saved)) {
					$term_by_slug = [];
					foreach ($all_terms as $t) { $term_by_slug[$t->slug] = $t; }
					foreach ($saved as $slug) { if (isset($term_by_slug[$slug])) $ordered[] = $term_by_slug[$slug]; }
					foreach ($all_terms as $t) { if (!in_array($t->slug, $saved, true)) $ordered[] = $t; }
				} else { $ordered = array_values($all_terms); }
				foreach ($ordered as $t) : $checked = empty($saved) || in_array($t->slug, $saved, true) ? 'checked' : ''; ?>
				<li style="display:flex;align-items:center;gap:10px;padding:7px 10px;margin:0 0 3px;background:#fff;border:1px solid #e0d5c3;border-radius:5px;cursor:grab">
					<span style="color:#bbb;font-size:16px;cursor:grab;user-select:none">⠿</span>
					<input type="hidden" name="ib_opts[home_cats][]" value="_disabled_">
					<label style="display:flex;align-items:center;gap:6px;flex:1;cursor:pointer">
						<input type="checkbox" name="ib_opts[home_cats][]" value="<?php echo esc_attr($t->slug); ?>" <?php echo $checked; ?>>
						<span style="color:#3E2C1B;font-size:13px"><?php echo esc_html($t->name); ?></span>
					</label>
				</li>
				<?php endforeach; ?>
			</ul>
			<script>jQuery(function($){$('#ib-home-cats').sortable({axis:'y',handle:'span',placeholder:'ui-state-highlight'});$('#ib-home-cats').disableSelection();});</script>
		<?php self::card_close(); ?>
		</div>
		<div>
		<?php self::card_open('🖼️', 'Banner responsivo', 'Exibido abaixo de "Mais recentes" na home. Desktop 1200x300, tablet 800x250, mobile 600x250.'); ?>
			<?php foreach ([
				'banner_image' => 'Desktop',
				'banner_image_tablet' => 'Tablet',
				'banner_image_mobile' => 'Mobile',
			] as $fk => $flbl) : $fval = self::opt($fk); ?>
			<p>
				<label for="<?php echo esc_attr($fk); ?>" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px;color:#3E2C1B"><?php echo esc_html($flbl); ?></label>
				<span style="display:flex;gap:6px;flex-wrap:wrap">
					<input type="url" id="<?php echo esc_attr($fk); ?>" name="ib_opts[<?php echo esc_attr($fk); ?>]" value="<?php echo esc_attr($fval); ?>" class="large-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px;flex:1;min-width:140px">
					<button type="button" class="button" data-media-pick="<?php echo esc_attr($fk); ?>">Selecionar</button>
					<button type="button" class="button" data-media-clear="<?php echo esc_attr($fk); ?>">Remover</button>
				</span>
				<?php if ($fval) : ?>
					<br><img id="preview-<?php echo esc_attr($fk); ?>" src="<?php echo esc_url($fval); ?>" alt="" style="max-width:240px;height:auto;margin-top:6px;border:1px solid #dcdcde;border-radius:4px">
				<?php else : ?>
					<br><img id="preview-<?php echo esc_attr($fk); ?>" alt="" style="display:none;max-width:240px;height:auto;margin-top:6px;border:1px solid #dcdcde;border-radius:4px">
				<?php endif; ?>
			</p>
			<?php endforeach; ?>
			<p>
				<label for="banner_link" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px;color:#3E2C1B">Link do banner</label>
				<input type="url" id="banner_link" name="ib_opts[banner_link]" value="<?php echo esc_attr(self::opt('banner_link')); ?>" class="large-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px">
			</p>
		<?php self::card_close(); ?>
		</div>
		<?php
	}

	private static function render_tab_conteudo() {
		?>
		<div>
		<?php
		self::card_open('📌', 'Sidebar — Sobre', 'Biografia exibida na barra lateral do site.');
		self::card_table_open(); ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0;vertical-align:top"><label for="sidebar_bio" style="color:#3E2C1B;font-weight:600">Biografia</label></th>
				<td style="padding:8px 0"><textarea id="sidebar_bio" name="ib_opts[sidebar_bio]" rows="4" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea(self::opt('sidebar_bio')); ?></textarea></td>
			</tr>
		<?php
		self::card_table_close();
		self::card_close();
		?>
		</div>
		<div>
		<?php
		self::card_open('📝', 'Rodape');
		self::card_table_open(); ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0"><label for="footer_tagline" style="color:#3E2C1B;font-weight:600">Frase</label></th>
				<td style="padding:8px 0"><input type="text" id="footer_tagline" name="ib_opts[footer_tagline]" value="<?php echo esc_attr(self::opt('footer_tagline')); ?>" class="large-text" style="border-color:#e0d5c3;border-radius:4px"></td>
			</tr>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0;vertical-align:top"><label for="footer_about" style="color:#3E2C1B;font-weight:600">Sobre</label></th>
				<td style="padding:8px 0"><textarea id="footer_about" name="ib_opts[footer_about]" rows="2" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea(self::opt('footer_about')); ?></textarea></td>
			</tr>
		<?php
		self::card_table_close();
		self::card_close();
		?>
		</div>
		<?php
	}

	private static function render_tab_aparencia() {
		?>
		<div>
		<?php self::card_open('🔤', 'Fontes', 'Defina as fontes usadas no site. As alteracoes aparecem na hora.'); ?>
			<p>
				<label for="font_heading" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px;color:#3E2C1B">Titulos</label>
				<select id="font_heading" name="ib_opts[font_heading]" style="width:100%;border-color:#e0d5c3;border-radius:4px;padding:4px 6px">
					<?php $h = self::opt('font_heading'); $serif_opts = [
						'Literata' => 'Literata', 'Merriweather' => 'Merriweather',
						'Playfair+Display' => 'Playfair Display', 'Lora' => 'Lora',
						'PT+Serif' => 'PT Serif', 'Source+Serif+4' => 'Source Serif 4',
						'Cormorant' => 'Cormorant', 'Cormorant+Upright' => 'Cormorant Upright',
						'Red+Hat+Display' => 'Red Hat Display', 'Fraunces' => 'Fraunces',
						'Epilogue' => 'Epilogue',
						'Georgia' => 'Georgia (nativa)', 'System' => 'Sistema (sem Google Fonts)',
					]; foreach ($serif_opts as $v => $l) : ?>
						<option value="<?php echo esc_attr($v); ?>" <?php selected($h, $v); ?>><?php echo esc_html($l); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="font_body" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px;color:#3E2C1B">Corpo</label>
				<select id="font_body" name="ib_opts[font_body]" style="width:100%;border-color:#e0d5c3;border-radius:4px;padding:4px 6px">
					<?php $b = self::opt('font_body'); $sans_opts = [
						'Inter' => 'Inter', 'Source+Sans+3' => 'Source Sans 3',
						'Nunito' => 'Nunito', 'Work+Sans' => 'Work Sans',
						'DM+Sans' => 'DM Sans', 'System' => 'Sistema (nativa)',
					]; foreach ($sans_opts as $v => $l) : ?>
						<option value="<?php echo esc_attr($v); ?>" <?php selected($b, $v); ?>><?php echo esc_html($l); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php self::card_close(); ?>
		</div>
		<div></div>
		<?php
	}

	public static function render_newsletter() {
		if (!current_user_can('manage_options')) return;
		$subs = (array) get_option('ib_newsletter_subscribers', []);

		if (!empty($_GET['export'])) {
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=assinantes-newsletter.csv');
			echo "\xEF\xBB\xBF";
			echo "E-mail\n";
			foreach ($subs as $email) {
				echo '"' . str_replace('"', '""', $email) . "\"\n";
			}
			exit;
		}
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px">
				<span class="dashicons dashicons-email-alt" style="font-size:32px;width:32px;height:32px"></span>
				Newsletter — Assinantes
			</h1>
			<p style="font-size:14px;color:#6D5940">
				<strong style="color:#3E2C1B"><?php echo count($subs); ?></strong> assinante(s) cadastrado(s).
				<a href="?page=ib-newsletter&amp;export=1" class="button" style="margin-left:12px">📥 Exportar CSV</a>
			</p>
			<?php if (empty($subs)) : ?>
				<div class="notice notice-info"><p>Nenhum assinante cadastrado ainda.</p></div>
			<?php else : ?>
				<table class="wp-list-table widefat fixed striped" style="max-width:600px">
					<thead><tr><th>E-mail</th></tr></thead>
					<tbody>
						<?php foreach ($subs as $email) : ?>
							<tr><td><?php echo esc_html($email); ?></td></tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
		<?php
	}
}
}

namespace {
	if (! function_exists('ib_opt')) {
		function ib_opt($key) { return \IrenilsonBarbosa\Core\AdminSettings::opt($key); }
	}
	if (! function_exists('ib_opts')) {
		function ib_opts() { return \IrenilsonBarbosa\Core\AdminSettings::opts(); }
	}
}
