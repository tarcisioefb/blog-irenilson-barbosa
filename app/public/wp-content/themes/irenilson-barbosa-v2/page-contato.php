<?php
/** IRENILSON BARBOSA — Página de Contato com formulário. */
defined('ABSPATH') || exit;

// Processa envio
$msg_sent = false;
$msg_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ib_contact_nonce'])) {
	if (wp_verify_nonce($_POST['ib_contact_nonce'], 'ib_contact')) {
		$name = sanitize_text_field($_POST['ib_name'] ?? '');
		$email = sanitize_email($_POST['ib_email'] ?? '');
		$subject = sanitize_text_field($_POST['ib_subject'] ?? '');
		$message = sanitize_textarea_field($_POST['ib_message'] ?? '');

		if (!$name || !$email || !$message) {
			$msg_error = 'Preencha todos os campos obrigatórios.';
		} elseif (!is_email($email)) {
			$msg_error = 'E-mail inválido.';
		} else {
			$to = get_option('admin_email');
			$headers = ['Content-Type: text/html; charset=UTF-8', "Reply-To: $email"];
			$body = "<p><strong>Nome:</strong> $name</p>
					<p><strong>E-mail:</strong> $email</p>
					<p><strong>Assunto:</strong> " . ($subject ?: '(sem assunto)') . "</p>
					<hr><p>" . nl2br($message) . "</p>";

			if (wp_mail($to, "Contato via site: " . ($subject ?: 'Mensagem'), $body, $headers)) {
				$msg_sent = true;
			} else {
				$msg_error = 'Erro ao enviar. Tente novamente mais tarde.';
			}
		}
	} else {
		$msg_error = 'Erro de segurança. Recarregue a página.';
	}
}

get_header(); ?>
<div class="wrap" id="main" style="padding-top:var(--space-10);padding-bottom:var(--space-10)">
	<?php ib_breadcrumb(); ?>

	<?php if ($msg_sent) : ?>
		<div role="status" style="padding:var(--space-4) var(--space-5);background:#EDF2E8;border:1px solid #B5C6A2;border-radius:var(--radius-md);color:#3B4A30;margin-bottom:var(--space-6)">✓ Mensagem enviada com sucesso! Obrigado pelo contato.</div>
	<?php elseif ($msg_error) : ?>
		<div role="alert" style="padding:var(--space-4) var(--space-5);background:#FEF2F2;border:1px solid #FECACA;border-radius:var(--radius-md);color:#991B1B;margin-bottom:var(--space-6)">✗ <?php echo esc_html($msg_error); ?></div>
	<?php endif; ?>

	<div style="display:grid;grid-template-columns:1fr 340px;gap:var(--space-10);align-items:start">
		<div>
			<h1 style="font-family:var(--font-heading);font-size:var(--text-3xl);color:var(--ink);margin:0 0 var(--space-2)">Contato</h1>
			<p style="color:var(--tx-2);margin:0 0 var(--space-8)">Envie uma mensagem. Responderei assim que possível.</p>

			<form method="post" style="display:flex;flex-direction:column;gap:var(--space-5)">
				<?php wp_nonce_field('ib_contact', 'ib_contact_nonce'); ?>
				<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:var(--space-4)">

				<div>
					<label for="ib_name" style="display:block;font-size:var(--text-sm);font-weight:var(--weight-semibold);color:var(--ink);margin-bottom:6px">Nome *</label>
					<input type="text" id="ib_name" name="ib_name" required value="<?php echo esc_attr($_POST['ib_name'] ?? ''); ?>" style="width:100%;padding:var(--space-3) var(--space-3);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-sm);font-family:inherit;font-size:var(--text-md);background:#fff">
				</div>

				<div>
					<label for="ib_email" style="display:block;font-size:var(--text-sm);font-weight:var(--weight-semibold);color:var(--ink);margin-bottom:6px">E-mail *</label>
					<input type="email" id="ib_email" name="ib_email" required value="<?php echo esc_attr($_POST['ib_email'] ?? ''); ?>" style="width:100%;padding:var(--space-3) var(--space-3);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-sm);font-family:inherit;font-size:var(--text-md);background:#fff">
				</div>

				<div>
					<label for="ib_subject" style="display:block;font-size:var(--text-sm);font-weight:var(--weight-semibold);color:var(--ink);margin-bottom:6px">Assunto</label>
					<input type="text" id="ib_subject" name="ib_subject" value="<?php echo esc_attr($_POST['ib_subject'] ?? ''); ?>" style="width:100%;padding:var(--space-3) var(--space-3);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-sm);font-family:inherit;font-size:var(--text-md);background:#fff">
				</div>
				</div>

				<div>
					<label for="ib_message" style="display:block;font-size:var(--text-sm);font-weight:var(--weight-semibold);color:var(--ink);margin-bottom:6px">Mensagem *</label>
					<textarea id="ib_message" name="ib_message" required rows="6" style="width:100%;padding:var(--space-3) var(--space-3);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-sm);font-family:inherit;font-size:var(--text-md);background:#fff;resize:vertical"><?php echo esc_textarea($_POST['ib_message'] ?? ''); ?></textarea>
				</div>

				<button type="submit" style="align-self:flex-start;padding:var(--space-3) var(--space-8);background:var(--ink);color:#fff;border:none;border-radius:var(--radius-md);font-weight:var(--weight-semibold);font-size:var(--text-md);cursor:pointer">Enviar mensagem</button>
			</form>
		</div>

		<div style="padding:var(--space-6);background:var(--paper-2);border:var(--border-w) solid var(--border-c);border-radius:var(--radius-lg);position:sticky;top:140px">
			<h2 style="font-family:var(--font-heading);font-size:var(--text-xl);color:var(--ink);margin:0 0 6px">Newsletter</h2>
			<p style="color:var(--tx-2);margin:0 0 var(--space-4);font-size:var(--text-13)">Receba os novos artigos por e-mail.</p>
			<?php ib_newsletter_form(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
