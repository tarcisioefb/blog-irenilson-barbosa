<?php
/** IRENILSON BARBOSA — Central de ajustes no painel. */
defined( 'ABSPATH' ) || exit;

function ib_opts_defaults() {
	return [
		'social_facebook'  => '',
		'social_instagram' => '',
		'social_youtube'   => '',
		'footer_tagline'   => 'Professor universitário, escritor e pesquisador.',
		'footer_about'     => 'Doutor em Educação pela UFBA. Autor de ensaios sobre filosofia, educação, política e cultura.',
		'sidebar_bio'      => 'Professor universitário, escritor e pesquisador. Doutor em Educação, autor de ensaios sobre filosofia, política, educação e cultura.',
	];
}

function ib_opts() {
	static $o = null;
	if ( null === $o ) {
		$o = wp_parse_args( (array) get_option( 'ib_opts', [] ), ib_opts_defaults() );
	}
	return $o;
}

function ib_opt( $key ) {
	$o = ib_opts();
	return $o[ $key ] ?? '';
}

add_action( 'admin_menu', function () {
	add_menu_page(
		'Central do Site',
		'Central do Site',
		'manage_options',
		'ib-ajustes',
		'ib_settings_page',
		'dashicons-admin-site-alt3',
		3
	);
} );

add_action( 'admin_init', function () {
	register_setting( 'ib_group', 'ib_opts', [
		'type'              => 'array',
		'sanitize_callback' => 'ib_opts_sanitize',
		'default'           => ib_opts_defaults(),
	] );
} );

function ib_opts_sanitize( $in ) {
	$in  = is_array( $in ) ? $in : [];
	$out = [];
	foreach ( [ 'social_facebook', 'social_instagram', 'social_youtube' ] as $k ) {
		$out[ $k ] = isset( $in[ $k ] ) ? esc_url_raw( trim( $in[ $k ] ) ) : '';
	}
	$out['footer_tagline'] = isset( $in['footer_tagline'] ) ? sanitize_text_field( $in['footer_tagline'] ) : '';
	$out['footer_about']   = isset( $in['footer_about'] ) ? sanitize_textarea_field( $in['footer_about'] ) : '';
	$out['sidebar_bio']    = isset( $in['sidebar_bio'] ) ? sanitize_textarea_field( $in['sidebar_bio'] ) : '';
	return $out;
}

add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( 'toplevel_page_ib-ajustes' !== $hook ) { return; }
	wp_enqueue_media();
	wp_enqueue_script( 'ib-admin', get_template_directory_uri() . '/assets/ib-admin.js', [ 'jquery' ], IRENILSON_VER, true );
} );

function ib_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	?>
	<div class="wrap">
		<h1 style="display:flex;align-items:center;gap:12px">
			<span class="dashicons dashicons-admin-site-alt3" style="font-size:32px;width:32px;height:32px"></span>
			Central do Site — Irenilson Barbosa
		</h1>

		<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
			<div class="notice notice-success is-dismissible"><p>Alterações salvas.</p></div>
		<?php endif; ?>

		<div style="max-width:780px;margin:24px 0;padding:20px 24px;background:#FAF7F2;border-left:4px solid #4A5D3E;border-radius:4px;font-size:14px;line-height:1.6">
			<strong style="color:#3E2C1B">💡 Ajuste rápido</strong><br>
			As alterações aparecem no site na hora. Campos em branco usam o valor padrão do tema.
		</div>

		<form method="post" action="options.php">
			<?php settings_fields( 'ib_group' ); ?>

			<div style="max-width:780px">
				<!-- Redes Sociais -->
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
					<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">🔗 Redes sociais</h2>
					<p style="margin:0 0 20px;color:#6D5940;font-size:13px">Aparecem no topo do site. Deixe em branco para ocultar.</p>
					<table class="form-table" role="presentation" style="margin:0"><tbody>
						<?php foreach ( [ 'social_facebook' => 'Facebook', 'social_instagram' => 'Instagram', 'social_youtube' => 'YouTube' ] as $k => $lbl ) : ?>
							<tr>
								<th scope="row" style="width:120px;padding:8px 0"><label for="<?php echo esc_attr( $k ); ?>" style="color:#3E2C1B;font-weight:600"><?php echo esc_html( $lbl ); ?></label></th>
								<td style="padding:8px 0"><input type="url" id="<?php echo esc_attr( $k ); ?>" name="ib_opts[<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( ib_opt( $k ) ); ?>" class="regular-text" placeholder="https://..." style="border-color:#e0d5c3;border-radius:4px"></td>
							</tr>
						<?php endforeach; ?>
					</tbody></table>
				</div>

				<!-- Sidebar -->
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
					<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">📌 Sidebar — Sobre</h2>
					<p style="margin:0 0 20px;color:#6D5940;font-size:13px">Texto da caixa "Sobre" na barra lateral.</p>
					<table class="form-table" role="presentation" style="margin:0"><tbody>
						<tr>
							<th scope="row" style="width:120px;padding:8px 0;vertical-align:top"><label for="sidebar_bio" style="color:#3E2C1B;font-weight:600">Biografia</label></th>
							<td style="padding:8px 0"><textarea id="sidebar_bio" name="ib_opts[sidebar_bio]" rows="4" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea( ib_opt( 'sidebar_bio' ) ); ?></textarea></td>
						</tr>
					</tbody></table>
				</div>

				<!-- Footer -->
				<div style="background:#fff;border:1px solid #e0d5c3;border-radius:8px;padding:24px;margin-bottom:20px">
					<h2 style="margin:0 0 4px;font-size:16px;color:#3E2C1B">📝 Rodapé</h2>
					<p style="margin:0 0 20px;color:#6D5940;font-size:13px">Textos exibidos no rodapé do site.</p>
					<table class="form-table" role="presentation" style="margin:0"><tbody>
						<tr>
							<th scope="row" style="width:120px;padding:8px 0"><label for="footer_tagline" style="color:#3E2C1B;font-weight:600">Frase</label></th>
							<td style="padding:8px 0"><input type="text" id="footer_tagline" name="ib_opts[footer_tagline]" value="<?php echo esc_attr( ib_opt( 'footer_tagline' ) ); ?>" class="large-text" style="border-color:#e0d5c3;border-radius:4px"></td>
						</tr>
						<tr>
							<th scope="row" style="width:120px;padding:8px 0;vertical-align:top"><label for="footer_about" style="color:#3E2C1B;font-weight:600">Sobre</label></th>
							<td style="padding:8px 0"><textarea id="footer_about" name="ib_opts[footer_about]" rows="2" class="large-text" style="border-color:#e0d5c3;border-radius:4px"><?php echo esc_textarea( ib_opt( 'footer_about' ) ); ?></textarea></td>
						</tr>
					</tbody></table>
				</div>
			</div>

			<?php submit_button( 'Salvar alterações', 'primary', 'submit', true, [ 'style' => 'background:#3E2C1B;border-color:#3E2C1B;border-radius:4px;padding:8px 28px;height:auto;font-size:14px' ] ); ?>
		</form>
	</div>
	<?php
}
