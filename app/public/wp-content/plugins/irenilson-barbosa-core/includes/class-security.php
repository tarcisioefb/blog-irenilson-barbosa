<?php
namespace IrenilsonBarbosa\Core;

class Security {
	public static function init() {
		add_action('init', [__CLASS__, 'disable_xmlrpc']);
		add_filter('rest_authentication_errors', [__CLASS__, 'restrict_rest_api']);
		add_action('wp_login_failed', [__CLASS__, 'track_login_failed']);
		add_filter('authenticate', [__CLASS__, 'check_login_locked'], 30, 3);
		add_action('wp_loaded', [__CLASS__, 'clean_debug_log']);
		add_action('login_head', [__CLASS__, 'custom_login_logo']);
		add_filter('login_headerurl', [__CLASS__, 'custom_login_url']);
		add_filter('login_headertext', [__CLASS__, 'custom_login_title']);
		add_filter('wp_headers', [__CLASS__, 'security_headers']);
	}

	public static function security_headers($headers) {
		if (is_admin()) return $headers;
		$headers['X-Content-Type-Options'] = 'nosniff';
		$headers['X-Frame-Options'] = 'SAMEORIGIN';
		$headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains';
		$headers['Cross-Origin-Opener-Policy'] = 'same-origin';
		$csp = "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google-analytics.com; object-src 'none'; frame-ancestors 'none'; base-uri 'self'; upgrade-insecure-requests";
		if (!empty($headers['Content-Security-Policy'])) {
			$headers['Content-Security-Policy'] .= '; ' . $csp;
		} else {
			$headers['Content-Security-Policy'] = $csp;
		}
		if (!is_user_logged_in()) {
			$headers['Cache-Control'] = 'no-cache, must-revalidate';
		}
		return $headers;
	}

	public static function custom_login_logo() {
		$logo = \IrenilsonBarbosa\Core\AdminSettings::opt('site_logo');
		?>
		<style>
		body.login {
			background: #f5f0e8;
		}
		body.login div#login form#loginform {
			border: 1px solid #e0d5c3;
			border-radius: 8px;
			box-shadow: 0 4px 16px rgba(62,44,27,.08);
			background: #fff;
		}
		body.login .wp-core-ui .button-primary {
			background: #4a5d3e;
			border-color: #4a5d3e;
			box-shadow: none;
			text-shadow: none;
		}
		body.login .wp-core-ui .button-primary:hover {
			background: #3d4f33;
			border-color: #3d4f33;
		}
		body.login .wp-core-ui .button-primary:focus {
			box-shadow: 0 0 0 1px #fff, 0 0 0 3px #4a5d3e;
		}
		body.login input[type=text]:focus,
		body.login input[type=password]:focus {
			border-color: #4a5d3e;
			box-shadow: 0 0 0 1px #4a5d3e;
		}
		body.login .message,
		body.login #login_error {
			border-left-color: #4a5d3e;
		}
		body.login .privacy-policy-page-link a,
		body.login a {
			color: #5d704f;
		}
		body.login a:hover {
			color: #3d4f33;
		}
		#login h1 a {
			background-image: url('<?php echo esc_url($logo); ?>') !important;
			background-size: contain !important;
			background-position: center !important;
			width: auto !important;
			max-width: 280px;
			height: 80px;
			pointer-events: none;
		}
		</style>
		<?php
	}

	public static function custom_login_url() {
		return home_url('/');
	}

	public static function custom_login_title() {
		return get_bloginfo('name');
	}

	public static function disable_xmlrpc() {
		add_filter('xmlrpc_enabled', '__return_false');
		add_action('send_headers', function () {
			header_remove('X-Powered-By');
		});
	}

	public static function restrict_rest_api($result) {
		if (!empty($result)) return $result;
		if (is_user_logged_in()) return $result;
		$route = $GLOBALS['wp']->query_vars['rest_route'] ?? '';
		$public = ['/oembed/', '/wp/v2/posts', '/wp/v2/pages', '/wp/v2/categories', '/wp/v2/tags', '/litespeed/'];
		foreach ($public as $p) {
			if (strpos($route, $p) === 0) return $result;
		}
		return new \WP_Error('rest_not_logged_in', 'Acesso à API requer autenticação.', ['status' => 401]);
	}

	public static function track_login_failed($username) {
		$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
		$attempts = (array) \get_transient('ib_login_attempts_' . $ip);
		$attempts[] = time();
		\set_transient('ib_login_attempts_' . $ip, $attempts, 900);
		$uattempts = (array) \get_transient('ib_login_attempts_user_' . $username);
		$uattempts[] = time();
		\set_transient('ib_login_attempts_user_' . $username, $uattempts, 900);
	}

	public static function check_login_locked($user, $username, $password) {
		if (!$username || \is_wp_error($user)) return $user;
		$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
		$attempts = (array) \get_transient('ib_login_attempts_' . $ip);
		$recent = array_values(array_filter($attempts, fn($t) => $t > time() - 900));
		if (count($recent) >= 5) {
			return new \WP_Error('too_many_attempts', 'Muitas tentativas de login. Aguarde 15 minutos.');
		}
		$uattempts = (array) \get_transient('ib_login_attempts_user_' . $username);
		$recent_u = array_values(array_filter($uattempts, fn($t) => $t > time() - 900));
		if (count($recent_u) >= 5) {
			return new \WP_Error('too_many_attempts', 'Muitas tentativas para este usuário. Aguarde 15 minutos.');
		}
		return $user;
	}

	public static function clean_debug_log() {
		if (!wp_next_scheduled('ib_clean_debug_log')) {
			wp_schedule_event(time(), 'weekly', 'ib_clean_debug_log');
		}
		add_action('ib_clean_debug_log', function () {
			$log = WP_CONTENT_DIR . '/debug.log';
			if (file_exists($log) && filesize($log) > 5 * 1024 * 1024) {
				file_put_contents($log, '');
			}
		});
	}
}
