<?php
namespace IrenilsonBarbosa\Core;

class Magazine {
	public static function init() {
		add_action('add_meta_boxes', [__CLASS__, 'add_destaque_metabox']);
		add_action('save_post', [__CLASS__, 'save_destaque_metabox']);
	}

	public static function add_destaque_metabox() {
		add_meta_box(
			'irenilson_destaque',
			'Destaque na Home',
			[__CLASS__, 'render_destaque_metabox'],
			'post',
			'side',
			'high'
		);
	}

	public static function render_destaque_metabox($post) {
		wp_nonce_field('irenilson_destaque', 'irenilson_destaque_nonce');

		$current = get_post_meta($post->ID, 'destaque_tipo', true);
		$options = [
			''       => 'Nenhum',
			'hero'   => 'Hero (destaque principal)',
			'grid'   => 'Grid (cards secundários)',
		];
		?>
		<select name="destaque_tipo" style="width:100%">
			<?php foreach ($options as $value => $label) : ?>
				<option value="<?php echo esc_attr($value); ?>" <?php selected($current, $value); ?>>
					<?php echo esc_html($label); ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
	}

	public static function save_destaque_metabox($post_id) {
		if (! isset($_POST['irenilson_destaque_nonce'])
			|| ! wp_verify_nonce($_POST['irenilson_destaque_nonce'], 'irenilson_destaque')
			|| defined('DOING_AUTOSAVE') && DOING_AUTOSAVE
		) {
			return;
		}

		$value = sanitize_text_field($_POST['destaque_tipo'] ?? '');
		update_post_meta($post_id, 'destaque_tipo', $value);
	}
}
