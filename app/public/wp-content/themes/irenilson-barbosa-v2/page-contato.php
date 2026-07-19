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
<div class="wrap" style="padding-top:40px;padding-bottom:60px">
	<div style="max-width:640px;margin:0 auto">
		<h1 style="font-family:var(--serif);font-size:clamp(1.5rem,3vw,2rem);color:var(--ink);margin:0 0 8px">Contato</h1>
		<p style="color:var(--tx-2);margin:0 0 32px">Envie uma mensagem. Responderei assim que possível.</p>

		<?php if ($msg_sent) : ?>
			<div style="padding:16px 20px;background:#EDF2E8;border:1px solid #B5C6A2;border-radius:8px;color:#3B4A30;margin-bottom:24px">Mensagem enviada com sucesso! Obrigado pelo contato.</div>
		<?php elseif ($msg_error) : ?>
			<div style="padding:16px 20px;background:#FEF2F2;border:1px solid #FECACA;border-radius:8px;color:#991B1B;margin-bottom:24px"><?php echo esc_html($msg_error); ?></div>
		<?php endif; ?>

		<form method="post" style="display:flex;flex-direction:column;gap:20px">
			<?php wp_nonce_field('ib_contact', 'ib_contact_nonce'); ?>

			<div>
				<label for="ib_name" style="display:block;font-size:0.875rem;font-weight:600;color:var(--ink);margin-bottom:6px">Nome *</label>
				<input type="text" id="ib_name" name="ib_name" required value="<?php echo esc_attr($_POST['ib_name'] ?? ''); ?>" style="width:100%;padding:12px 14px;border:1px solid var(--line);border-radius:6px;font-family:inherit;font-size:1rem;background:#fff;transition:border-color .2s" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor=''">
			</div>

			<div>
				<label for="ib_email" style="display:block;font-size:0.875rem;font-weight:600;color:var(--ink);margin-bottom:6px">E-mail *</label>
				<input type="email" id="ib_email" name="ib_email" required value="<?php echo esc_attr($_POST['ib_email'] ?? ''); ?>" style="width:100%;padding:12px 14px;border:1px solid var(--line);border-radius:6px;font-family:inherit;font-size:1rem;background:#fff;transition:border-color .2s" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor=''">
			</div>

			<div>
				<label for="ib_subject" style="display:block;font-size:0.875rem;font-weight:600;color:var(--ink);margin-bottom:6px">Assunto</label>
				<input type="text" id="ib_subject" name="ib_subject" value="<?php echo esc_attr($_POST['ib_subject'] ?? ''); ?>" style="width:100%;padding:12px 14px;border:1px solid var(--line);border-radius:6px;font-family:inherit;font-size:1rem;background:#fff;transition:border-color .2s" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor=''">
			</div>

			<div>
				<label for="ib_message" style="display:block;font-size:0.875rem;font-weight:600;color:var(--ink);margin-bottom:6px">Mensagem *</label>
				<textarea id="ib_message" name="ib_message" required rows="6" style="width:100%;padding:12px 14px;border:1px solid var(--line);border-radius:6px;font-family:inherit;font-size:1rem;background:#fff;resize:vertical;transition:border-color .2s" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor=''"><?php echo esc_textarea($_POST['ib_message'] ?? ''); ?></textarea>
			</div>

			<button type="submit" style="align-self:flex-start;padding:14px 32px;background:var(--ink);color:#fff;border:none;border-radius:8px;font-weight:600;font-size:1rem;cursor:pointer;transition:background .2s" onmouseover="this.style.background='#2C1E11'" onmouseout="this.style.background='var(--ink)'">Enviar mensagem</button>
		</form>
	</div>
</div>
<?php get_footer(); ?>
