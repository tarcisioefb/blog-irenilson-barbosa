<?php
namespace IrenilsonBarbosa\Core;

class Newsletter {
	public static function init() {
		add_action('wp_ajax_ib_newsletter', [__CLASS__, 'ajax_handler']);
		add_action('wp_ajax_nopriv_ib_newsletter', [__CLASS__, 'ajax_handler']);
		add_action('admin_menu', [__CLASS__, 'admin_page']);
	}

	public static function ajax_handler() {
		$email = sanitize_email($_POST['email'] ?? '');
		if (! is_email($email)) {
			wp_send_json_error('E-mail inválido.');
		}

		$subs = self::get_subscribers();
		if (in_array($email, $subs, true)) {
			wp_send_json_error('Este e-mail já está cadastrado.');
		}

		$subs[] = $email;
		update_option('ib_newsletter_subscribers', $subs);
		wp_send_json_success('Cadastro realizado com sucesso!');
	}

	public static function get_subscribers() {
		return (array) get_option('ib_newsletter_subscribers', []);
	}

	public static function admin_page() {
		add_submenu_page(
			'ib-ajustes',
			'Newsletter — Assinantes',
			'Newsletter',
			'manage_options',
			'ib-newsletter',
			[__CLASS__, 'render_admin']
		);
	}

	public static function render_admin() {
		if (! current_user_can('manage_options')) return;

		$subs = self::get_subscribers();

		// Export CSV
		if (! empty($_GET['export'])) {
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=assinantes-newsletter.csv');
			echo "\xEF\xBB\xBF"; // BOM UTF-8
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
