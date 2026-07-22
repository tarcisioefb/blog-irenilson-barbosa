<?php
namespace IrenilsonBarbosa\Core;

class Security {
	public static function init() {
		add_action('init', [__CLASS__, 'disable_xmlrpc']);
		add_filter('rest_authentication_errors', [__CLASS__, 'restrict_rest_api']);
		add_action('wp_login_failed', [__CLASS__, 'track_login_failed']);
		add_filter('authenticate', [__CLASS__, 'check_login_locked'], 30, 3);
		add_action('wp_loaded', [__CLASS__, 'clean_debug_log']);
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
		$public = ['/oembed/', '/wp/v2/posts', '/wp/v2/pages', '/wp/v2/categories', '/wp/v2/tags'];
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
