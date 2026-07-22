<?php
namespace IrenilsonBarbosa\Core {

class AdminSettings {
	public static function init() {
		add_action('admin_menu', [__CLASS__, 'register_menus']);
		add_action('admin_init', [__CLASS__, 'register_settings']);
		add_filter('user_has_cap', [__CLASS__, 'grant_editor_cap'], 10, 3);
		add_action('admin_init', [__CLASS__, 'migrate_smtp_password']);
		add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
		add_action('wp_dashboard_setup', [__CLASS__, 'dashboard_widgets']);
		add_action('wp_before_admin_bar_render', [__CLASS__, 'admin_bar_cache']);
		add_action('wp_head', [__CLASS__, 'output_google_analytics'], 0);
		add_action('wp_ajax_ib_newsletter', [__CLASS__, 'ajax_newsletter']);
		add_action('wp_ajax_nopriv_ib_newsletter', [__CLASS__, 'ajax_newsletter']);
		add_action('wp_ajax_ib_preview_post', [__CLASS__, 'ajax_preview_post']);
		add_action('wp_ajax_ib_purge_cache', [__CLASS__, 'ajax_purge_cache']);
		add_action('wp_ajax_ib_reindex', [__CLASS__, 'ajax_reindex']);
		add_action('phpmailer_init', [__CLASS__, 'configure_smtp']);
		add_action('init', [__CLASS__, 'handle_unsubscribe']);
		add_action('admin_init', [__CLASS__, 'remove_tools_menu']);
		add_action('admin_head', [__CLASS__, 'admin_head_editor']);
		add_action('admin_post_ib_save_settings', [__CLASS__, 'handle_save_settings']);
		add_action('admin_notices', [__CLASS__, 'admin_notices']);
	}

	public static function grant_editor_cap($allcaps, $caps, $args) {
		if (!empty($allcaps['edit_others_posts'])) {
			$allcaps['edit_pages'] = true;
		}
		return $allcaps;
	}

	public static function admin_head_editor() {
		if (!current_user_can("editor")) return;
		?><style>.user-url-wrap,.user-language-wrap,.user-admin-color-wrap,.user-comment-shortcuts-wrap,.application-passwords,.user-sessions-wrap{display:none!important}</style><?php
	}

	public static function admin_notices() {
		if (isset($_GET['ib_reindexed']) && $_GET['ib_reindexed'] === '1') {
			echo '<div class="notice notice-success is-dismissible"><p>🔍 Google notificado para reindexar o sitemap.</p></div>';
		}
	}

	public static function remove_tools_menu() {
		if (!current_user_can('editor')) return;
		remove_menu_page('tools.php');
		remove_menu_page('edit-comments.php');
		remove_menu_page('edit.php?post_type=page');
	}

	public static function admin_bar_cache() {
		if (!current_user_can('edit_pages')) return;
		global $wp_admin_bar;
		$wp_admin_bar->remove_node("comments");
		$wp_admin_bar->add_node([
			'id' => 'ib-purge-cache',
			'title' => '⚡ Limpar cache',
			'href' => admin_url('admin-ajax.php?action=ib_purge_cache&_wpnonce=' . wp_create_nonce('ib_purge')),
			'meta' => ['class' => 'ib-cache-btn'],
		]);
		$wp_admin_bar->add_node([
			'id' => 'ib-reindex',
			'title' => '🔍 Reindexar Google',
			'href' => admin_url('admin-ajax.php?action=ib_reindex&_wpnonce=' . wp_create_nonce('ib_reindex')),
			'meta' => ['class' => 'ib-reindex-btn'],
		]);
	}

	public static function ajax_purge_cache() {
		if (!wp_verify_nonce($_GET['_wpnonce'] ?? '', 'ib_purge')) wp_die('Falha de segurança.');
		if (!current_user_can('edit_pages')) wp_die('Sem permissão.');

		if (function_exists('LiteSpeed_Cache_API')) {
			LiteSpeed_Cache_API::purge_all();
		} elseif (has_action('litespeed_purge_all')) {
			do_action('litespeed_purge_all');
		} else {
			wp_cache_flush();
		}

		wp_redirect(wp_get_referer() ?: admin_url());
		exit;
	}

	public static function ajax_reindex() {
		if (!wp_verify_nonce($_GET['_wpnonce'] ?? '', 'ib_reindex')) wp_die('Falha de segurança.');
		if (!current_user_can('edit_pages')) wp_die('Sem permissão.');
		$sitemap = urlencode(home_url('/wp-sitemap.xml'));
		$resp = wp_remote_get("https://www.google.com/ping?sitemap=$sitemap", ['timeout' => 15]);
		if (is_wp_error($resp)) {
			wp_die('Erro ao notificar Google: ' . $resp->get_error_message());
		}
		wp_redirect(add_query_arg('ib_reindexed', '1', wp_get_referer() ?: admin_url()));
		exit;
	}

	public static function handle_save_settings() {
		if (!wp_verify_nonce($_POST['ib_settings_nonce'] ?? '', 'ib_save_settings')) {
			wp_die('Falha de segurança.');
		}
		if (!current_user_can('edit_pages')) {
			wp_die('Sem permissão.');
		}
		$in = isset($_POST['ib_opts']) && is_array($_POST['ib_opts']) ? $_POST['ib_opts'] : [];
		update_option('ib_opts', self::sanitize($in), false);
		wp_redirect(add_query_arg('settings-updated', '1', wp_get_referer() ?: admin_url('admin.php?page=ib-ajustes')));
		exit;
	}

	public static function dashboard_widgets() {
		wp_add_dashboard_widget('ib_dashboard_welcome', 'Irenilson Barbosa — Visão geral', [__CLASS__, 'render_dashboard']);
	}

	public static function render_dashboard() {
		$types = [
			'post' => ['Artigo', 'editor'],
			'publicacao' => ['Publicacao', 'publicacao'],
			'livro' => ['Livro', 'livro'],
			'poiesis' => ['Poema', 'poiesis'],
			'material' => ['Material', 'material'],
		];
		?>
		<div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px">
			<?php foreach ($types as $slug => $t) : ?>
			<a href="<?php echo admin_url('post-new.php?post_type=' . $slug); ?>" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:#4A5D3E;color:#fff;text-decoration:none;border-radius:4px;font-size:13px;font-weight:600">+ <?php echo esc_html($t[0]); ?></a>
			<?php endforeach; ?>
		</div>
		<p style="font-size:13px;margin:0 0 8px"><strong>Links rápidos:</strong></p>
		<ul style="font-size:13px;margin:0;list-style:none;padding:0">
			<li style="margin-bottom:6px"><a href="<?php echo admin_url('admin.php?page=ib-ajustes'); ?>">⚙️ Configurações do site</a></li>
			<li style="margin-bottom:6px"><a href="<?php echo admin_url('admin.php?page=ib-newsletter'); ?>">📬 Enviar newsletter</a></li>
			<li style="margin-bottom:6px"><a href="<?php echo admin_url('admin.php?page=ib-tutoriais'); ?>">📖 Tutoriais</a></li>
			<li style="margin-bottom:6px"><a href="<?php echo admin_url('edit.php?post_type=poiesis'); ?>">📝 Ver todos os poemas</a></li>
			<li style="margin-bottom:6px"><a href="<?php echo admin_url('edit.php?post_type=livro'); ?>">📚 Ver todos os livros</a></li>
		</ul>
		<?php
	}

	public static function handle_unsubscribe() {
		if (!isset($_GET['ib_unsubscribe'])) return;
		$email = sanitize_email($_GET['ib_unsubscribe']);
		if (!$email) { wp_die('Link inválido.'); return; }

		$subs = (array) get_option('ib_newsletter_subscribers', []);
		$key = array_search($email, $subs, true);
		if ($key !== false) {
			unset($subs[$key]);
			update_option('ib_newsletter_subscribers', array_values($subs), false);
		}
		wp_die('<p>Você foi removido da newsletter.</p><p>Seu e-mail <strong>' . esc_html($email) . '</strong> não receberá mais nossas atualizações.</p><p><a href="' . esc_url(home_url('/')) . '">Voltar para o site</a></p>', 'Newsletter — Cancelamento confirmado');
	}

	public static function configure_smtp($phpmailer) {
		$host = self::opt('smtp_host');
		if (!$host) return;
		$phpmailer->isSMTP();
		$phpmailer->Host = $host;
		$phpmailer->Port = self::opt('smtp_port') ?: 587;
		$phpmailer->SMTPAuth = true;
		$phpmailer->Username = self::opt('smtp_user');
		$phpmailer->Password = self::opt_decrypted('smtp_pass');
		$phpmailer->SMTPSecure = self::opt('smtp_encrypt') ?: 'tls';
		$phpmailer->From = self::opt('smtp_user') ?: 'contato@irenilsonbarbosa.com';
		$phpmailer->FromName = get_bloginfo('name');
	}

	public static function ajax_newsletter() {
		$email = isset($_POST['email']) ? sanitize_email(trim($_POST['email'])) : '';
		if (!is_email($email)) {
			wp_send_json_error('E-mail inválido.');
		}
		$subs = (array) get_option('ib_newsletter_subscribers', []);
		if (in_array($email, $subs, true)) {
			wp_send_json_error('E-mail já cadastrado.');
		}
		$subs[] = $email;
		update_option('ib_newsletter_subscribers', array_values(array_unique($subs)), false);
		wp_send_json_success('Cadastrado com sucesso!');
	}

	public static function defaults() {
		return [
			'social_facebook'  => '',
			'social_instagram' => '',
			'social_youtube'   => '',
			'footer_tagline'   => 'Professor universitário, escritor e pesquisador.',
			'footer_about'     => 'Doutor em Educação pela UFBA. Autor de ensaios sobre filosofia, educação, política e cultura.',
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
			'contact_email'    => '',
			'arch_desc_artigos' => 'Ensaios, reflexões e artigos sobre filosofia, educação, política, cultura e cotidiano.',
			'arch_desc_publicacoes' => 'Publicações acadêmicas de Irenilson Barbosa — artigos científicos, capítulos de livros e ensaios.',
			'arch_desc_livros' => 'Obras de Irenilson Barbosa — autor, organizador e coautor.',
			'arch_desc_materiais' => 'Materiais educacionais para download — slides, apostilas e guias.',
			'arch_desc_poiesis' => 'Poemas e criações literárias de Irenilson Barbosa.',
			'smtp_host'    => '',
			'smtp_port'    => '',
			'smtp_user'    => '',
			'smtp_pass'    => '',
			'smtp_encrypt' => 'tls',
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
		global $submenu;
		if (isset($submenu["ib-ajustes"][0][0])) {
			$submenu["ib-ajustes"][0][0] = "Ajustes";
		}
		add_menu_page(
			'Irenilson Barbosa — Configurações',
			'Irenilson Barbosa',
			'edit_pages',
			'ib-ajustes',
			[__CLASS__, 'render_page'],
			'dashicons-admin-site-alt3',
			3
		);

		add_submenu_page(
			'ib-ajustes',
			'Newsletter',
			'Newsletter',
			'edit_pages',
			'ib-newsletter',
			[__CLASS__, 'render_newsletter']
		);

		add_submenu_page(
			'ib-ajustes',
			'Tutoriais — Irenilson Barbosa',
			'Tutoriais',
			'edit_pages',
			'ib-tutoriais',
			[__CLASS__, 'render_tutoriais']
		);
	}

	public static function register_settings() {
		$args = [
			'type'              => 'array',
			'capability'        => 'edit_pages',
			'sanitize_callback' => [__CLASS__, 'sanitize'],
			'default'           => self::defaults(),
		];
		register_setting('ib_group', 'ib_opts', $args);
		add_filter('option_page_capability_ib_group', function() { return 'edit_pages'; });
	}

	public static function sanitize($in) {
		$in  = is_array($in) ? $in : [];
		$cur = (array) get_option('ib_opts', []);
		$out = $cur;

		foreach (['social_facebook', 'social_instagram', 'social_youtube'] as $k) {
			if (array_key_exists($k, $in)) $out[$k] = esc_url_raw(trim($in[$k]));
		}
		if (array_key_exists('footer_tagline', $in)) $out['footer_tagline'] = sanitize_text_field($in['footer_tagline']);
		if (array_key_exists('footer_about', $in)) $out['footer_about'] = sanitize_textarea_field($in['footer_about']);
		$allowed_heading = ['Literata', 'Merriweather', 'Playfair+Display', 'Lora', 'PT+Serif', 'Source+Serif+4', 'Cormorant', 'Cormorant+Upright', 'Red+Hat+Display', 'Fraunces', 'Epilogue', 'Georgia', 'System'];
		if (array_key_exists('site_logo', $in)) $out['site_logo'] = esc_url_raw(trim($in['site_logo']));
		if (array_key_exists('font_heading', $in)) $out['font_heading'] = in_array($in['font_heading'], $allowed_heading, true) ? $in['font_heading'] : 'Literata';
		$allowed_body = ['Inter', 'Source+Sans+3', 'Nunito', 'Work+Sans', 'DM+Sans', 'System'];
		if (array_key_exists('font_body', $in)) $out['font_body'] = in_array($in['font_body'], $allowed_body, true) ? $in['font_body'] : 'Inter';
		if (array_key_exists('facebook_app_id', $in)) $out['facebook_app_id'] = sanitize_text_field(trim($in['facebook_app_id']));
		if (array_key_exists('home_cats', $in)) {
			$out['home_cats'] = [];
			if (is_array($in['home_cats'])) {
				$out['home_cats'] = array_values(array_filter(
					array_map('sanitize_text_field', $in['home_cats']),
					fn($v) => $v !== '_disabled_'
				));
			}
		}
		if (array_key_exists('banner_image', $in)) $out['banner_image'] = esc_url_raw(trim($in['banner_image']));
		if (array_key_exists('banner_image_tablet', $in)) $out['banner_image_tablet'] = esc_url_raw(trim($in['banner_image_tablet']));
		if (array_key_exists('banner_image_mobile', $in)) $out['banner_image_mobile'] = esc_url_raw(trim($in['banner_image_mobile']));
		if (array_key_exists('banner_link', $in)) $out['banner_link'] = esc_url_raw(trim($in['banner_link']));
		if (array_key_exists('google_analytics_id', $in)) $out['google_analytics_id'] = sanitize_text_field(trim($in['google_analytics_id']));
		if (array_key_exists("contact_email", $in)) $out["contact_email"] = sanitize_email(trim($in["contact_email"]));
		foreach (['arch_desc_artigos', 'arch_desc_publicacoes', 'arch_desc_livros', 'arch_desc_materiais', 'arch_desc_poiesis'] as $k) {
			if (array_key_exists($k, $in)) $out[$k] = sanitize_textarea_field($in[$k]);
		}
		if (array_key_exists('smtp_host', $in)) $out['smtp_host'] = sanitize_text_field(trim($in['smtp_host']));
		if (array_key_exists('smtp_port', $in)) $out['smtp_port'] = sanitize_text_field(trim($in['smtp_port']));
		if (array_key_exists('smtp_user', $in)) $out['smtp_user'] = sanitize_email(trim($in['smtp_user']));
		if (array_key_exists('smtp_pass', $in)) {
			$pass = $in['smtp_pass'];
			if ($pass !== '' && !self::is_encrypted($pass)) {
				$out['smtp_pass'] = self::encrypt($pass);
			}
		}
		if (array_key_exists('smtp_encrypt', $in)) $out['smtp_encrypt'] = in_array($in['smtp_encrypt'], ['tls', 'ssl', ''], true) ? $in['smtp_encrypt'] : 'tls';
		return $out;
	}

	private static function enc_key() {
		return defined('AUTH_KEY') ? AUTH_KEY . AUTH_SALT : 'ib-fallback-key';
	}

	private static function is_encrypted($val) {
		return is_string($val) && strpos($val, 'ib_enc:') === 0;
	}

	private static function encrypt($plain) {
		$iv = openssl_random_pseudo_bytes(16);
		$cipher = openssl_encrypt($plain, 'aes-256-cbc', self::enc_key(), OPENSSL_RAW_DATA, $iv);
		return 'ib_enc:' . base64_encode($iv) . ':' . base64_encode($cipher);
	}

	private static function decrypt($val) {
		if (!self::is_encrypted($val)) return $val;
		$parts = explode(':', $val, 3);
		if (count($parts) < 3) return '';
		$iv = base64_decode($parts[1]);
		$cipher = base64_decode($parts[2]);
		$decrypted = openssl_decrypt($cipher, 'aes-256-cbc', self::enc_key(), OPENSSL_RAW_DATA, $iv);
		return $decrypted !== false ? $decrypted : '';
	}

	public static function opt_decrypted($key) {
		$val = self::opt($key);
		return self::is_encrypted($val) ? self::decrypt($val) : $val;
	}

	public static function migrate_smtp_password() {
		$opts = (array) get_option('ib_opts', []);
		if (!empty($opts['smtp_pass']) && !self::is_encrypted($opts['smtp_pass'])) {
			$opts['smtp_pass'] = self::encrypt($opts['smtp_pass']);
			update_option('ib_opts', $opts, false);
		}
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
<script>
window.ibGID = '<?php echo esc_js($ga_id); ?>';
var accepted = localStorage.getItem('ib-cookies-accepted');
if (accepted === '1') {
	(function(){var s=document.createElement('script');s.src='https://www.googletagmanager.com/gtag/js?id=<?php echo esc_js($ga_id); ?>';s.async=true;document.head.appendChild(s);window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo esc_js($ga_id); ?>',{'anonymize_ip':true});})();
}
</script>
		<?php
	}

	public static function render_page() {
		if (!current_user_can('edit_pages')) return;
		$tab = $_GET['tab'] ?? 'geral';
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px">
				<span class="dashicons dashicons-admin-site-alt3" style="font-size:32px;width:32px;height:32px"></span>
				Irenilson Barbosa — Configurações
			</h1>

			<?php if (isset($_GET['settings-updated'])) : ?>
				<div class="notice notice-success is-dismissible"><p>Alterações salvas.</p></div>
			<?php endif; ?>

			<nav class="nav-tab-wrapper" style="margin-bottom:20px">
				<a href="?page=ib-ajustes&amp;tab=geral" class="nav-tab <?php echo $tab === 'geral' ? 'nav-tab-active' : ''; ?>">Geral</a>
				<a href="?page=ib-ajustes&amp;tab=home" class="nav-tab <?php echo $tab === 'home' ? 'nav-tab-active' : ''; ?>">Home</a>
				<a href="?page=ib-ajustes&amp;tab=conteudo" class="nav-tab <?php echo $tab === 'conteudo' ? 'nav-tab-active' : ''; ?>">Conteúdo</a>
				<a href="?page=ib-ajustes&amp;tab=aparencia" class="nav-tab <?php echo $tab === 'aparencia' ? 'nav-tab-active' : ''; ?>">Aparência</a>
			</nav>

			<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
				<?php wp_nonce_field('ib_save_settings', 'ib_settings_nonce'); ?>
				<input type="hidden" name="action" value="ib_save_settings">

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
				<?php submit_button('Salvar alterações', 'primary', 'submit', true, ['style' => 'background:#3E2C1B;border-color:#3E2C1B;border-radius:4px;padding:8px 28px;height:auto;font-size:14px']); ?>
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

		self::card_open('🖼️', 'Logo', 'Usado no cabeçalho e rodapé. PNG ou SVG, largura max. 240px.');
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
		self::card_open('📊', 'Google Analytics', 'Insira o ID de medição (ex.: G-XXXXXXXXXX) para ativar o Google Analytics 4.');
		self::card_table_open(); ?>
			<tr>
				<th scope="row" style="width:80px;padding:6px 0"><label for="google_analytics_id" style="color:#3E2C1B;font-weight:600;font-size:12px">GA4 ID</label></th>
				<td style="padding:6px 0"><input type="text" id="google_analytics_id" name="ib_opts[google_analytics_id]" value="<?php echo esc_attr(self::opt('google_analytics_id')); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" style="border-color:#e0d5c3;border-radius:4px"></td>
			</tr>
		<?php
		self::card_table_close();
		self::card_close();

		self::card_open('📧', 'E-mail SMTP', 'Configure o servidor SMTP para garantir a entrega dos emails do formulário de contato.');
		self::card_table_open(); ?>
			<tr><th scope="row" style="width:80px;padding:6px 0"><label for="smtp_host" style="color:#3E2C1B;font-weight:600;font-size:12px">Host</label></th><td style="padding:6px 0"><input type="text" id="smtp_host" name="ib_opts[smtp_host]" value="<?php echo esc_attr(self::opt('smtp_host')); ?>" class="regular-text" placeholder="smtp.hostinger.com" style="border-color:#e0d5c3;border-radius:4px"></td></tr>
			<tr><th scope="row" style="width:80px;padding:6px 0"><label for="smtp_port" style="color:#3E2C1B;font-weight:600;font-size:12px">Porta</label></th><td style="padding:6px 0"><input type="text" id="smtp_port" name="ib_opts[smtp_port]" value="<?php echo esc_attr(self::opt('smtp_port')); ?>" class="small-text" placeholder="587" style="border-color:#e0d5c3;border-radius:4px"></td></tr>
			<tr><th scope="row" style="width:80px;padding:6px 0"><label for="smtp_user" style="color:#3E2C1B;font-weight:600;font-size:12px">Usuário</label></th><td style="padding:6px 0"><input type="text" id="smtp_user" name="ib_opts[smtp_user]" value="<?php echo esc_attr(self::opt('smtp_user')); ?>" class="regular-text" placeholder="contato@..." style="border-color:#e0d5c3;border-radius:4px"></td></tr>
			<tr><th scope="row" style="width:80px;padding:6px 0"><label for="smtp_pass" style="color:#3E2C1B;font-weight:600;font-size:12px">Senha</label></th><td style="padding:6px 0"><input type="password" id="smtp_pass" name="ib_opts[smtp_pass]" value="" class="regular-text" style="border-color:#e0d5c3;border-radius:4px" placeholder="Deixe vazio para manter a atual"></td></tr>
			<tr><th scope="row" style="width:80px;padding:6px 0"><label for="smtp_encrypt" style="color:#3E2C1B;font-weight:600;font-size:12px">Criptografia</label></th><td style="padding:6px 0"><select id="smtp_encrypt" name="ib_opts[smtp_encrypt]" style="border-color:#e0d5c3;border-radius:4px"><option value="tls" <?php selected(self::opt('smtp_encrypt'), 'tls'); ?>>TLS</option><option value="ssl" <?php selected(self::opt('smtp_encrypt'), 'ssl'); ?>>SSL</option><option value="" <?php selected(self::opt('smtp_encrypt'), ''); ?>>Nenhuma</option></select></td></tr>
		<?php
		self::card_table_close();
		self::card_close();

		self::card_open('📧', 'E-mail de contato', 'E-mail que recebe as mensagens do formulário de contato.');
		self::card_table_open(); ?>
			<tr><th scope="row" style="width:80px;padding:6px 0"><label for="contact_email" style="color:#3E2C1B;font-weight:600;font-size:12px">Destino</label></th><td style="padding:6px 0"><input type="email" id="contact_email" name="ib_opts[contact_email]" value="<?php echo esc_attr(self::opt('contact_email')); ?>" class="regular-text" placeholder="contato@..." style="border-color:#e0d5c3;border-radius:4px"></td></tr>
		<?php
		self::card_table_close();
		self::card_close();


		self::card_open('💬', 'Comentários do Facebook');
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
				<li style="display:flex;align-items:center;gap:6px;padding:7px 10px;margin:0 0 3px;background:#fff;border:1px solid #e0d5c3;border-radius:5px">
					<span class="ib-drag-handle" style="color:#bbb;font-size:16px;cursor:grab;user-select:none">⠿</span>
					<span class="ib-up-btn" style="cursor:pointer;color:#888;font-size:14px;line-height:1">▲</span>
					<span class="ib-down-btn" style="cursor:pointer;color:#888;font-size:14px;line-height:1">▼</span>
					<input type="hidden" name="ib_opts[home_cats][]" value="_disabled_">
					<label style="display:flex;align-items:center;gap:6px;flex:1;cursor:pointer;user-select:none">
						<input type="checkbox" name="ib_opts[home_cats][]" value="<?php echo esc_attr($t->slug); ?>" <?php echo $checked; ?>>
						<span style="color:#3E2C1B;font-size:13px"><?php echo esc_html($t->name); ?></span>
					</label>
				</li>
				<?php endforeach; ?>
			</ul>
			<script>
jQuery(function($){
	$('#ib-home-cats').sortable({axis:'y',handle:'.ib-drag-handle',placeholder:'ui-state-highlight'});
	$('#ib-home-cats').disableSelection();
	$('#ib-home-cats').on('click','.ib-up-btn,.ib-down-btn',function(){
		var li=$(this).closest('li'),ul=li.closest('ul');
		if($(this).is('.ib-up-btn')){
			var prev=li.prev('li');
			if(prev.length) li.insertBefore(prev);
		}else{
			var next=li.next('li');
			if(next.length) li.insertAfter(next);
		}
	});
});
</script>
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
		self::card_open('📂', 'Descrição dos arquivos', 'Texto exibido abaixo do título em cada página de listagem.');
		self::card_table_open();
		$arch_fields = [
			'arch_desc_artigos' => 'Artigos',
			'arch_desc_publicacoes' => 'Publicações',
			'arch_desc_livros' => 'Livros',
			'arch_desc_materiais' => 'Materiais',
			'arch_desc_poiesis' => 'Poiésis',
		];
		foreach ($arch_fields as $k => $lbl) : ?>
			<tr><th scope="row" style="width:80px;padding:6px 0;vertical-align:top"><label for="<?php echo esc_attr($k); ?>" style="color:#3E2C1B;font-weight:600;font-size:12px"><?php echo esc_html($lbl); ?></label></th>
			<td style="padding:6px 0"><textarea id="<?php echo esc_attr($k); ?>" name="ib_opts[<?php echo esc_attr($k); ?>]" rows="2" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea(self::opt($k)); ?></textarea></td></tr>
		<?php endforeach;
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
		<?php self::card_open('🔤', 'Fontes', 'Defina as fontes usadas no site. As alterações aparecem na hora.'); ?>
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
		if (!current_user_can('edit_pages')) return;
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

		$sent = false;
		$send_error = '';
		if (!empty($_POST['ib_send_post']) && !empty($subs)) {
			$post_id = (int) $_POST['ib_send_post'];
			$post = get_post($post_id);
			if ($post) {
				$sent = self::send_newsletter_email($post);
				if (!$sent) $send_error = 'Falha ao enviar. Verifique o SMTP.';
			} else {
				$send_error = 'Post inválido.';
			}
		}

		$recent = get_posts(['posts_per_page' => 20, 'post_type' => ['post', 'publicacao', 'livro', 'poiesis', 'material'], 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC']);
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px">
				<span class="dashicons dashicons-email-alt" style="font-size:32px;width:32px;height:32px"></span>
				Newsletter
			</h1>

			<?php if ($sent) : ?>
				<div class="notice notice-success is-dismissible"><p>E-mail enviado com sucesso para <?php echo count($subs); ?> assinante(s).</p></div>
			<?php elseif ($send_error) : ?>
				<div class="notice notice-error is-dismissible"><p><?php echo esc_html($send_error); ?></p></div>
			<?php endif; ?>

			<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
				<div>
					<h2 style="font-size:15px;color:#3E2C1B;margin:0 0 12px">📬 Enviar novo e-mail</h2>
					<form method="post" style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:16px">
						<p><label for="ib_send_post" style="display:block;font-weight:600;margin-bottom:4px;color:#3E2C1B;font-size:13px">Selecione o post</label>
						<select id="ib_send_post" name="ib_send_post" style="width:100%;padding:6px;border-color:#e0d5c3;border-radius:4px">
							<option value="">— Selecione —</option>
							<?php foreach ($recent as $p) : ?>
							<option value="<?php echo $p->ID; ?>">[<?php echo esc_html(get_post_type_object($p->post_type)->labels->singular_name ?? $p->post_type); ?>] <?php echo esc_html($p->post_title); ?></option>
							<?php endforeach; ?>
						</select></p>

						<div id="ib-newsletter-preview" style="display:none;margin:16px 0;padding:16px;background:var(--paper-2);border-radius:6px">
							<h3 style="font-size:14px;color:#3E2C1B;margin:0 0 8px">Preview do e-mail</h3>
							<div id="ib-preview-content"></div>
						</div>

						<p><button type="submit" class="button button-primary" id="ib-send-btn" disabled style="background:#3E2C1B;border-color:#3E2C1B;padding:6px 24px;height:auto;font-size:14px">📤 Enviar para <?php echo count($subs); ?> assinante(s)</button></p>
					</form>

					<script>
					document.getElementById('ib_send_post').onchange = function() {
						var id = this.value;
						var preview = document.getElementById('ib-newsletter-preview');
						var content = document.getElementById('ib-preview-content');
						var btn = document.getElementById('ib-send-btn');
						if (!id) { preview.style.display = 'none'; btn.disabled = true; return; }
						fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=ib_preview_post&id=' + id)
						.then(function(r){return r.json()}).then(function(d){
							if (d.success) {
								content.innerHTML = d.data.html;
								preview.style.display = 'block';
								btn.disabled = false;
							}
						});
					};
					</script>
				</div>
				<div>
					<h2 style="font-size:15px;color:#3E2C1B;margin:0 0 12px">📋 Assinantes</h2>
					<p style="font-size:13px;color:#6D5940;margin:0 0 8px"><?php echo count($subs); ?> assinante(s). <a href="?page=ib-newsletter&amp;export=1">📥 Exportar CSV</a></p>
					<?php if (empty($subs)) : ?>
						<div class="notice notice-info"><p>Nenhum assinante cadastrado.</p></div>
					<?php else : ?>
						<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;max-height:320px;overflow-y:auto">
							<table class="wp-list-table widefat fixed striped" style="border:none">
								<tbody>
									<?php foreach ($subs as $email) : ?>
										<tr><td style="padding:6px 12px"><?php echo esc_html($email); ?></td></tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	public static function send_newsletter_email($post) {
		$subs = (array) get_option('ib_newsletter_subscribers', []);
		if (empty($subs) || !$post) return false;

		$type_name = mb_strtolower(get_post_type_object($post->post_type)->labels->singular_name ?? 'post');
		$permalink = get_permalink($post->ID);
		$title = $post->post_title;
		$excerpt = $post->post_excerpt ? $post->post_excerpt : wp_trim_words(strip_tags($post->post_content), 50);
		$thumb = get_the_post_thumbnail_url($post->ID, 'large');
		$date = get_the_date('j F Y', $post->ID);
		$unsub_url = home_url('/?ib_unsubscribe=');

		$body = '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><style>'
			. 'body{margin:0;padding:0;background-color:#F5F0E8;font-family:Georgia,"Times New Roman",serif}'
			. '.wrapper{max-width:600px;margin:0 auto;background:#FFFFFF;border-radius:8px;overflow:hidden}'
			. '.header{padding:32px 40px 0;text-align:center}'
			. '.header h1{font-size:22px;color:#3E2C1B;margin:0 0 4px;line-height:1.3}'
			. '.meta{font-size:13px;color:#6D5940;margin:0 0 24px}'
			. '.body{padding:0 40px 32px}'
			. '.body p{font-size:15px;line-height:1.7;color:#3E2C1B;margin:0 0 20px}'
			. '.btn-wrap{text-align:center;margin:28px 0 0}'
			. '.btn{display:inline-block;padding:14px 36px;background:#4A5D3E;color:#FFFFFF!important;text-decoration:none;border-radius:6px;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;letter-spacing:.3px}'
			. '.footer{background:#F5F0E8;padding:24px 40px;text-align:center;font-size:12px;color:#9E8A68;line-height:1.6}'
			. '.footer a{color:#6D5940;text-decoration:underline}'
			. 'img{max-width:100%;height:auto;border-radius:6px;display:block;margin:0 auto 24px}'
			. '@media(max-width:480px){.header{padding:24px 20px 0}.body{padding:0 20px 24px}.btn{display:block;text-align:center}}</style></head><body>'
			. '<div class="wrapper">'
			. '<div class="header"><h1>' . esc_html($title) . '</h1><p class="meta">' . esc_html($type_name) . ' &middot; ' . esc_html($date) . '</p></div>'
			. '<div class="body">'
			. ($thumb ? '<img src="' . esc_url($thumb) . '" alt="' . esc_attr($title) . '">' : '')
			. '<div class="body-text">' . wpautop($excerpt) . '</div>'
			. '<div class="btn-wrap"><a href="' . esc_url(add_query_arg(['utm_source' => 'newsletter', 'utm_medium' => 'email', 'utm_campaign' => 'novo_' . $post->post_type], $permalink)) . '" class="btn">Ver completo no Blog</a></div>'
			. '</div>'
			. '<div class="footer">'
			. '<p style="margin:0 0 8px">Você está recebendo este e-mail porque se inscreveu na newsletter do portal Irenilson Barbosa.</p>'
			. '<p style="margin:0"><a href="' . esc_url($unsub_url) . '">Cancelar inscrição</a> &nbsp;|&nbsp; <a href="' . esc_url(home_url('/privacidade/')) . '">Política de Privacidade</a></p>'
			. '</div></div></body></html>';

		$headers = ['Content-Type: text/html; charset=UTF-8', 'From: Irenilson Barbosa <contato@irenilsonbarbosa.com>'];
		$success = true;
		foreach ($subs as $email) {
			$email_body = str_replace(home_url("/?ib_unsubscribe="), home_url("/?ib_unsubscribe=" . urlencode(trim($email))), $body);
			if (!wp_mail(trim($email), $title, $email_body, $headers)) {
				$success = false;
			}
		}
		return $success;
	}

	public static function ajax_preview_post() {
		$id = (int) ($_GET['id'] ?? 0);
		$post = get_post($id);
		if (!$post) { wp_send_json_error(); return; }

		$type_name = mb_strtolower(get_post_type_object($post->post_type)->labels->singular_name ?? 'post');
		$title = $post->post_title;
		$excerpt = wp_trim_words(wp_strip_all_tags($post->post_content), 30);
		$thumb = get_the_post_thumbnail_url($post->ID, 'medium');
		$date = get_the_date('j F Y', $post->ID);

		$html = '<div style="font-family:Georgia,serif;color:#3E2C1B">'
			. '<h4 style="font-size:17px;margin:0 0 4px">' . esc_html($title) . '</h4>'
			. '<p style="font-size:12px;color:#6D5940;margin:0 0 8px">' . esc_html($type_name) . ' &middot; ' . esc_html($date) . '</p>'
			. ($thumb ? '<img src="' . esc_url($thumb) . '" style="max-width:100%;border-radius:4px;margin-bottom:8px">' : '')
			. '<p style="font-size:13px;color:#6D5940;line-height:1.5;margin:0">' . esc_html($excerpt) . '</p>'
			. '<p style="margin:8px 0 0"><span style="display:inline-block;padding:6px 16px;background:#4A5D3E;color:#fff;border-radius:4px;font-size:12px">Ver completo no Blog</span></p>'
			. '</div>';
		wp_send_json_success(['html' => $html]);
	}

	public static function render_tutoriais() {
		if (!current_user_can('edit_pages')) return;
		$types = [
			'post' => ['Artigos', 'Artigos (posts) são o conteúdo principal do blog. Use para ensaios, reflexões e notícias. O editor de blocos permite adicionar imagens, citações, galerias e muito mais.', 'Artigos', 'artigos', true],
			'publicacao' => ['Publicacoes', 'Publicações acadêmicas: artigos científicos, capítulos de livros e ensaios acadêmicos. Preencha os campos de ano, periódico/veículo, DOI e citação ABNT nos metadados abaixo do editor.', 'Publicacoes', 'publicacoes', false],
			'livro' => ['Livros', 'Livros de autoria, coautoria ou organização. Após preencher título e conteúdo (sinopse), use os campos de metadados para ano, editora, ISBN e páginas. Os links de compra são configurados em "Links de compra" com texto personalizado.', 'Livros', 'livros', false],
			'poiesis' => ['Poiesis (Poemas)', 'Poemas e criações literárias. O campo "Autor do poema" aparece abaixo do título — use para creditar o autor (nem sempre Irenilson). "Notas" é um campo opcional para texto explicativo ou dedicatória.', 'Poiésis', 'poiesis', false],
			'material' => ['Materiais', 'Materiais educacionais para download. Após criar o material, use o campo "Arquivo para download" para selecionar ou enviar o arquivo da biblioteca de mídia.', 'Materiais', 'materiais', false],
		];
		?>
		<div class="wrap">
			<h1 style="display:flex;align-items:center;gap:12px">
				<span class="dashicons dashicons-welcome-learn-more" style="font-size:32px;width:32px;height:32px"></span>
				Tutoriais — Irenilson Barbosa
			</h1>
			<p style="font-size:14px;color:#6D5940;margin:0 0 24px">Guia rápido para publicar e configurar o portal.</p>

			<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px">
					<h2 style="font-size:15px;color:#3E2C1B;margin:0 0 8px">🧭 Como publicar</h2>
					<p style="font-size:13px;color:#6D5940;line-height:1.6;margin:0">Vá em <strong>Posts > Adicionar novo</strong> (artigos) ou no tipo de conteúdo no menu lateral. Preencha título, corpo e metadados específicos de cada tipo na área abaixo do editor. Use o botao <strong>⚡ Limpar cache</strong> na barra superior ao finalizar.</p>
				</div>
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px">
					<h2 style="font-size:15px;color:#3E2C1B;margin:0 0 8px">🔧 Menu Irenilson Barbosa</h2>
					<p style="font-size:13px;color:#6D5940;line-height:1.6;margin:0">Acesse <strong>Irenilson Barbosa</strong> no menu lateral para configurar: redes sociais, logo, Google Analytics, fontes, banner da home, descrição dos arquivos, newsletter e email SMTP (abas: Geral, Home, Conteúdo, Aparência).</p>
				</div>
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px">
					<h2 style="font-size:15px;color:#3E2C1B;margin:0 0 8px">📬 Newsletter</h2>
					<p style="font-size:13px;color:#6D5940;line-height:1.6;margin:0">Para enviar um email com um post novo: vá em <strong>Irenilson Barbosa > Newsletter</strong>, selecione o post, veja a pré-visualização e clique em "Enviar". Os assinantes recebem o link com titulo, imagem e excerto.</p>
				</div>
			</div>

			<h2 style="font-size:18px;color:#3E2C1B;margin:32px 0 16px">Tipos de conteúdo</h2>
			<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
				<?php foreach ($types as $slug => $t) : ?>
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:20px">
					<h3 style="font-size:15px;color:#3E2C1B;margin:0 0 6px"><?php echo esc_html($t[0]); ?></h3>
					<p style="font-size:13px;color:#6D5940;line-height:1.6;margin:0 0 12px"><?php echo esc_html($t[1]); ?></p>
					<p style="margin:0"><a href="<?php echo admin_url('post-new.php?post_type=' . $slug); ?>" class="button button-primary" style="background:#4A5D3E;border-color:#4A5D3E">Criar <?php echo esc_html($t[2]); ?></a>
					<a href="<?php echo esc_url(home_url('/' . $t[3] . '/')); ?>" class="button" target="_blank" style="margin-left:6px">Ver no site</a></p>
				</div>
				<?php endforeach; ?>
			</div>
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
