<?php
namespace IrenilsonBarbosa\Core {

class AdminSettings {
	public static function init() {
		add_action('admin_menu', [__CLASS__, 'register_menus']);
		add_action('admin_init', [__CLASS__, 'register_settings']);
		add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
	}

	public static function defaults() {
		return [
			'social_facebook'  => '',
			'social_instagram' => '',
			'social_youtube'   => '',
			'footer_tagline'   => 'Professor universitário, escritor e pesquisador.',
			'footer_about'     => 'Doutor em Educação pela UFBA. Autor de ensaios sobre filosofia, educação, política e cultura.',
			'sidebar_bio'      => 'Professor universitário, escritor e pesquisador. Doutor em Educação, autor de ensaios sobre filosofia, política, educação e cultura.',
			'font_heading'     => 'Literata',
			'font_body'        => 'Inter',
			'facebook_app_id'  => '',
			'banner_image'        => '',
			'banner_image_tablet' => '',
			'banner_image_mobile' => '',
			'banner_link'         => '',
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
		$out['font_heading'] = in_array($in['font_heading'] ?? '', $allowed_heading, true) ? $in['font_heading'] : 'Literata';
		$allowed_body = ['Inter', 'Source+Sans+3', 'Nunito', 'Work+Sans', 'DM+Sans', 'System'];
		$out['font_body'] = in_array($in['font_body'] ?? '', $allowed_body, true) ? $in['font_body'] : 'Inter';
		$out['facebook_app_id'] = isset($in['facebook_app_id']) ? sanitize_text_field(trim($in['facebook_app_id'])) : '';
		$out['banner_image'] = isset($in['banner_image']) ? esc_url_raw(trim($in['banner_image'])) : '';
		$out['banner_image_tablet'] = isset($in['banner_image_tablet']) ? esc_url_raw(trim($in['banner_image_tablet'])) : '';
		$out['banner_image_mobile'] = isset($in['banner_image_mobile']) ? esc_url_raw(trim($in['banner_image_mobile'])) : '';
		$out['banner_link'] = isset($in['banner_link']) ? esc_url_raw(trim($in['banner_link'])) : '';
		return $out;
	}

	public static function enqueue_assets($hook) {
		if ('toplevel_page_ib-ajustes' !== $hook) return;
		wp_enqueue_media();
		$theme_uri = get_template_directory_uri();
		wp_enqueue_script('ib-admin', $theme_uri . '/assets/ib-admin.js', ['jquery'], IRENILSON_CORE_VERSION, true);
	}

	public static function render_page() {
		if (!current_user_can('manage_options')) return;
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px">
				<span class="dashicons dashicons-admin-site-alt3" style="font-size:32px;width:32px;height:32px"></span>
				Central do Site — Irenilson Barbosa
			</h1>

			<?php if (isset($_GET['settings-updated'])) : ?>
				<div class="notice notice-success is-dismissible"><p>Alterações salvas.</p></div>
			<?php endif; ?>

			<div style="max-width:780px;margin:24px 0;padding:20px 24px;background:#FAF7F2;border-left:4px solid #4A5D3E;border-radius:4px;font-size:14px;line-height:1.6">
				<strong style="color:#3E2C1B">💡 Ajuste rápido</strong><br>
				As alterações aparecem no site na hora. Campos em branco usam o valor padrão do tema.
			</div>

			<form method="post" action="options.php">
				<?php settings_fields('ib_group'); ?>

				<div style="max-width:780px">
					<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
						<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">🔗 Redes sociais</h2>
						<p style="margin:0 0 20px;color:#6D5940;font-size:13px">Aparecem no topo do site.</p>
						<table class="form-table" role="presentation" style="margin:0"><tbody>
							<?php foreach (['social_facebook' => 'Facebook', 'social_instagram' => 'Instagram', 'social_youtube' => 'YouTube'] as $k => $lbl) : ?>
								<tr>
									<th scope="row" style="width:120px;padding:8px 0"><label for="<?php echo esc_attr($k); ?>" style="color:#3E2C1B;font-weight:600"><?php echo esc_html($lbl); ?></label></th>
									<td style="padding:8px 0"><input type="url" id="<?php echo esc_attr($k); ?>" name="ib_opts[<?php echo esc_attr($k); ?>]" value="<?php echo esc_attr(self::opt($k)); ?>" class="regular-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
								</tr>
							<?php endforeach; ?>
						</tbody></table>
					</div>

					<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
						<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">📌 Sidebar — Sobre</h2>
						<table class="form-table" role="presentation" style="margin:0"><tbody>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0;vertical-align:top"><label for="sidebar_bio" style="color:#3E2C1B;font-weight:600">Biografia</label></th>
								<td style="padding:8px 0"><textarea id="sidebar_bio" name="ib_opts[sidebar_bio]" rows="4" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea(self::opt('sidebar_bio')); ?></textarea></td>
							</tr>
						</tbody></table>
					</div>

					<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
						<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">🖼️ Banner (Home)</h2>
						<p style="margin:0 0 20px;color:#6D5940;font-size:13px">Banner responsivo exibido abaixo de "Mais recentes" na home. Imagens diferentes para desktop, tablet e mobile — a ideal é landscape 1200x300, tablet 800x250, mobile 600x250.</p>
						<table class="form-table" role="presentation" style="margin:0"><tbody>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="banner_image" style="color:#3E2C1B;font-weight:600">Desktop</label></th>
								<td style="padding:8px 0"><input type="url" id="banner_image" name="ib_opts[banner_image]" value="<?php echo esc_attr(self::opt('banner_image')); ?>" class="large-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="banner_image_tablet" style="color:#3E2C1B;font-weight:600">Tablet</label></th>
								<td style="padding:8px 0"><input type="url" id="banner_image_tablet" name="ib_opts[banner_image_tablet]" value="<?php echo esc_attr(self::opt('banner_image_tablet')); ?>" class="large-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="banner_image_mobile" style="color:#3E2C1B;font-weight:600">Mobile</label></th>
								<td style="padding:8px 0"><input type="url" id="banner_image_mobile" name="ib_opts[banner_image_mobile]" value="<?php echo esc_attr(self::opt('banner_image_mobile')); ?>" class="large-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="banner_link" style="color:#3E2C1B;font-weight:600">Link</label></th>
								<td style="padding:8px 0"><input type="url" id="banner_link" name="ib_opts[banner_link]" value="<?php echo esc_attr(self::opt('banner_link')); ?>" class="large-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
						</tbody></table>
					</div>

					<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
						<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">📝 Rodapé</h2>
						<table class="form-table" role="presentation" style="margin:0"><tbody>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="footer_tagline" style="color:#3E2C1B;font-weight:600">Frase</label></th>
								<td style="padding:8px 0"><input type="text" id="footer_tagline" name="ib_opts[footer_tagline]" value="<?php echo esc_attr(self::opt('footer_tagline')); ?>" class="large-text" style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0;vertical-align:top"><label for="footer_about" style="color:#3E2C1B;font-weight:600">Sobre</label></th>
								<td style="padding:8px 0"><textarea id="footer_about" name="ib_opts[footer_about]" rows="2" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea(self::opt('footer_about')); ?></textarea></td>
							</tr>
						</tbody></table>
					</div>

					<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
						<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">💬 Comentários do Facebook</h2>
						<table class="form-table" role="presentation" style="margin:0"><tbody>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="facebook_app_id" style="color:#3E2C1B;font-weight:600">App ID</label></th>
								<td style="padding:8px 0"><input type="text" id="facebook_app_id" name="ib_opts[facebook_app_id]" value="<?php echo esc_attr(self::opt('facebook_app_id')); ?>" class="regular-text" placeholder="1234567890" style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
						</tbody></table>
					</div>

					<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
						<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">🔤 Fontes</h2>
						<table class="form-table" role="presentation" style="margin:0"><tbody>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="font_heading" style="color:#3E2C1B;font-weight:600">Títulos</label></th>
								<td style="padding:8px 0">
									<select id="font_heading" name="ib_opts[font_heading]" style="min-width:240px;border-color:#e0d5c3;border-radius:4px">
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
								</td>
							</tr>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="font_body" style="color:#3E2C1B;font-weight:600">Corpo</label></th>
								<td style="padding:8px 0">
									<select id="font_body" name="ib_opts[font_body]" style="min-width:240px;border-color:#e0d5c3;border-radius:4px">
										<?php $b = self::opt('font_body'); $sans_opts = [
											'Inter' => 'Inter', 'Source+Sans+3' => 'Source Sans 3',
											'Nunito' => 'Nunito', 'Work+Sans' => 'Work Sans',
											'DM+Sans' => 'DM Sans', 'System' => 'Sistema (nativa)',
										]; foreach ($sans_opts as $v => $l) : ?>
											<option value="<?php echo esc_attr($v); ?>" <?php selected($b, $v); ?>><?php echo esc_html($l); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
						</tbody></table>
					</div>
				</div>

				<?php submit_button('Salvar alterações', 'primary', 'submit', true, ['style' => 'background:#3E2C1B;border-color:#3E2C1B;border-radius:4px;padding:8px 28px;height:auto;font-size:14px']); ?>
			</form>
		</div>
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
