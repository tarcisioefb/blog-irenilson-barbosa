<?php
namespace IrenilsonBarbosa\Core;

class SEO {
	public static function init() {
		add_action('add_meta_boxes', [__CLASS__, 'add_meta_box']);
		add_action('add_meta_boxes', [__CLASS__, 'add_sobre_meta_box']);
		add_action('save_post', [__CLASS__, 'save_meta_box']);
		add_action('save_post', [__CLASS__, 'save_sobre_meta']);
		add_action('save_post', [__CLASS__, 'auto_description'], 20, 2);
		add_action('wp_head', [__CLASS__, 'output'], 1);
		add_filter('pre_get_document_title', [__CLASS__, 'filter_title']);
		add_filter('wp_title', [__CLASS__, 'filter_wp_title'], 10, 2);
		add_filter('robots_txt', [__CLASS__, 'robots_txt'], 10, 2);
		add_filter('wp_sitemaps_posts_entry', [__CLASS__, 'sitemap_image'], 10, 2);
		add_filter('the_excerpt_rss', [__CLASS__, 'rss_thumbnail']);
		add_filter('the_content_feed', [__CLASS__, 'rss_thumbnail']);
		add_action('add_meta_boxes', [__CLASS__, 'add_faq_meta_box']);
		add_action('save_post', [__CLASS__, 'save_faq_meta']);
		add_action('wp_ajax_ib_batch_seo', [__CLASS__, 'ajax_batch_seo']);
		add_action('wp_ajax_ib_gen_desc', [__CLASS__, 'ajax_gen_desc']);
		add_action('wp_ajax_ib_gen_editor', [__CLASS__, 'ajax_gen_editor']);
	}

	public static function robots_txt($output, $public) {
		if (!$public) return $output;
		return "User-agent: *\nAllow: /\nDisallow: /wp-admin/\nDisallow: /wp-includes/\nSitemap: " . home_url('/wp-sitemap.xml') . "\n";
	}

	public static function filter_title() {
		return self::get_title();
	}

	public static function filter_wp_title($title, $sep) {
		return self::get_title();
	}

	public static function add_sobre_meta_box() {
		\add_meta_box('ib-sobre', 'Sobre — Conteúdo da Página', [__CLASS__, 'render_sobre_meta'], 'page', 'normal', 'high');
	}

	public static function render_sobre_meta($post) {
		if ($post->post_name !== 'sobre') return;
		\wp_nonce_field('ib_sobre_save', 'ib_sobre_nonce');
		\wp_enqueue_media();

		$foto = \get_post_meta($post->ID, 'ib_sobre_foto', true);
		$desc = \get_post_meta($post->ID, 'ib_sobre_descricao', true);
		$formacao = \get_post_meta($post->ID, 'ib_sobre_formacao', true);
		$grupos = \get_post_meta($post->ID, 'ib_sobre_grupos', true);
		$pub = \get_post_meta($post->ID, 'ib_sobre_publicacoes', true);
		$email = \get_post_meta($post->ID, 'ib_sobre_email', true);
		?>
		<p style="font-size:12px;color:#666;margin:0 0 12px">Campos editáveis da página Sobre. Deixe vazio para usar o valor padrão.</p>
		<table class="form-table">
		<tr><th scope="row"><label style="font-weight:600;font-size:12px">Foto</label></th>
			<td><div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
				<div id="ib-foto-preview" style="width:80px;height:80px;border-radius:8px;overflow:hidden;background:#f0f0f1;flex-shrink:0"><?php if ($foto) : ?><img src="<?php echo esc_url($foto); ?>" style="width:100%;height:100%;object-fit:cover"><?php endif; ?></div>
				<div>
					<input type="hidden" id="ib_sobre_foto" name="ib_sobre_foto" value="<?php echo esc_attr($foto); ?>">
					<button type="button" class="button" id="ib-foto-btn" style="font-size:11px">Selecionar imagem</button>
					<button type="button" class="button" id="ib-foto-remove" style="font-size:11px;color:#b32d2e"<?php echo $foto ? '' : ' hidden'; ?>>Remover</button>
				</div>
			</div>
			<script>
			document.getElementById('ib-foto-btn')?.addEventListener('click',function(e){
				e.preventDefault(); var frame=wp.media({title:'Selecionar foto',button:{text:'Usar esta foto'},multiple:false});
				frame.on('select',function(){
					var url=frame.state().get('selection').first().toJSON().url;
					document.getElementById('ib_sobre_foto').value=url;
					document.getElementById('ib-foto-preview').innerHTML='<img src="'+url+'" style="width:100%;height:100%;object-fit:cover">';
					document.getElementById('ib-foto-remove').hidden=false;
				}); frame.open();
			});
			document.getElementById('ib-foto-remove')?.addEventListener('click',function(){
				document.getElementById('ib_sobre_foto').value='';
				document.getElementById('ib-foto-preview').innerHTML='';
				this.hidden=true;
			});
			</script></td></tr>
		<tr><th scope="row"><label for="ib_sobre_descricao" style="font-weight:600;font-size:12px">Descrição principal</label></th>
			<td><?php \wp_editor($desc, 'ib_sobre_descricao', ['textarea_rows' => 4, 'media_buttons' => false, 'teeny' => true, 'quicktags' => false]); ?></td></tr>
		<tr><th scope="row"><label style="font-weight:600;font-size:12px">Formação acadêmica</label></th>
			<td><div id="ib-formacao-list">
				<?php $items = $formacao ? array_filter(array_map('trim', explode("\n", $formacao))) : ['|']; foreach ($items as $i => $item) : $parts = explode('|', $item, 2); ?>
				<div class="ib-formacao-row" style="display:flex;gap:6px;margin-bottom:4px">
					<input type="text" name="ib_formacao_periodo[]" value="<?php echo esc_attr(trim($parts[0] ?? '')); ?>" placeholder="Período" style="width:100px;font-size:12px">
					<input type="text" name="ib_formacao_curso[]" value="<?php echo esc_attr(trim($parts[1] ?? $parts[0] ?? '')); ?>" placeholder="Curso / Instituição" style="flex:1;font-size:12px">
					<button type="button" class="button ib-formacao-remove" style="font-size:11px" onclick="this.parentElement.remove()">—</button>
				</div>
				<?php endforeach; ?>
			</div>
			<button type="button" class="button" id="ib-formacao-add" style="font-size:11px;margin-top:2px">+ Adicionar formação</button>
			<script>
			document.getElementById('ib-formacao-add')?.addEventListener('click',function(){
				var d=document.createElement('div');d.className='ib-formacao-row';d.style.cssText='display:flex;gap:6px;margin-bottom:4px';
				d.innerHTML='<input type="text" name="ib_formacao_periodo[]" placeholder="Período" style="width:100px;font-size:12px"> <input type="text" name="ib_formacao_curso[]" placeholder="Curso / Instituição" style="flex:1;font-size:12px"> <button type="button" class="button ib-formacao-remove" style="font-size:11px" onclick="this.parentElement.remove()">—</button>';
				document.getElementById('ib-formacao-list').appendChild(d);
			});
			</script></td></tr>
		<tr><th scope="row"><label for="ib_sobre_grupos" style="font-weight:600;font-size:12px">Grupos de pesquisa</label></th>
			<td><div id="ib-grupos-list">
				<?php $gitems = $grupos ? array_filter(array_map('trim', explode("\n", $grupos))) : ['']; foreach ($gitems as $g) : ?>
				<div class="ib-grupo-row" style="display:flex;gap:6px;margin-bottom:4px">
					<input type="text" name="ib_sobre_grupos[]" value="<?php echo esc_attr($g); ?>" placeholder="Nome do grupo (instituição)" style="flex:1;font-size:12px">
					<button type="button" class="button ib-grupo-remove" style="font-size:11px" onclick="this.parentElement.remove()">—</button>
				</div>
				<?php endforeach; ?>
			</div>
			<button type="button" class="button" id="ib-grupos-add" style="font-size:11px;margin-top:2px">+ Adicionar grupo</button>
			<script>
			document.getElementById('ib-grupos-add')?.addEventListener('click',function(){
				var d=document.createElement('div');d.className='ib-grupo-row';d.style.cssText='display:flex;gap:6px;margin-bottom:4px';
				d.innerHTML='<input type="text" name="ib_sobre_grupos[]" placeholder="Nome do grupo (instituição)" style="flex:1;font-size:12px"> <button type="button" class="button ib-grupo-remove" style="font-size:11px" onclick="this.parentElement.remove()">—</button>';
				document.getElementById('ib-grupos-list').appendChild(d);
			});
			</script></td></tr>
		<tr><th scope="row"><label for="ib_sobre_publicacoes" style="font-weight:600;font-size:12px">Pesquisa e publicações</label></th>
			<td><?php \wp_editor($pub, 'ib_sobre_publicacoes', ['textarea_rows' => 6, 'media_buttons' => false, 'teeny' => true, 'quicktags' => false]); ?></td></tr>
		<tr><th scope="row"><label for="ib_sobre_email" style="font-weight:600;font-size:12px">E-mail de contato</label></th>
			<td><input type="email" id="ib_sobre_email" name="ib_sobre_email" value="<?php echo esc_attr($email); ?>" style="width:100%;font-size:12px" placeholder="email@exemplo.com"></td></tr>
		<tr><th scope="row" style="padding-top:20px"><label style="font-weight:600;font-size:12px">Mais informações</label></th>
			<td style="padding-top:20px"><p style="font-size:11px;color:#666;margin:0 0 8px">Links acadêmicos — deixe vazio para usar o padrão.</p>
			<div style="display:flex;flex-direction:column;gap:4px">
				<input type="url" name="ib_sobre_lattes" value="<?php echo esc_attr(\get_post_meta($post->ID, 'ib_sobre_lattes', true)); ?>" placeholder="URL do Lattes" style="width:100%;font-size:12px;border:1px solid #8c8f94;border-radius:4px;padding:4px 8px">
				<input type="url" name="ib_sobre_scholar" value="<?php echo esc_attr(\get_post_meta($post->ID, 'ib_sobre_scholar', true)); ?>" placeholder="URL do Google Scholar" style="width:100%;font-size:12px;border:1px solid #8c8f94;border-radius:4px;padding:4px 8px">
				<input type="url" name="ib_sobre_orcid" value="<?php echo esc_attr(\get_post_meta($post->ID, 'ib_sobre_orcid', true)); ?>" placeholder="URL do ORCID" style="width:100%;font-size:12px;border:1px solid #8c8f94;border-radius:4px;padding:4px 8px">
			</div></td></tr>
		</table>
		<style>.ib-formacao-row input,.ib-grupo-row input{border:1px solid #8c8f94;border-radius:4px;padding:4px 8px}.ib-formacao-remove,.ib-grupo-remove{color:#b32d2e}.ib-formacao-remove:hover,.ib-grupo-remove:hover{color:#8a1f1f}</style>
		<?php
	}

	public static function save_sobre_meta($post_id) {
		if (!isset($_POST['ib_sobre_nonce']) || !\wp_verify_nonce($_POST['ib_sobre_nonce'], 'ib_sobre_save')) return;
		if (\defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (isset($_POST['ib_sobre_foto'])) \update_post_meta($post_id, 'ib_sobre_foto', \esc_url_raw($_POST['ib_sobre_foto']));
		if (isset($_POST['ib_sobre_descricao'])) \update_post_meta($post_id, 'ib_sobre_descricao', \sanitize_textarea_field($_POST['ib_sobre_descricao']));
		if (isset($_POST['ib_sobre_publicacoes'])) \update_post_meta($post_id, 'ib_sobre_publicacoes', \sanitize_textarea_field($_POST['ib_sobre_publicacoes']));
		if (isset($_POST['ib_sobre_email'])) \update_post_meta($post_id, 'ib_sobre_email', \sanitize_email($_POST['ib_sobre_email']));
		foreach (['ib_sobre_lattes', 'ib_sobre_scholar', 'ib_sobre_orcid'] as $k) {
			if (isset($_POST[$k])) \update_post_meta($post_id, $k, \esc_url_raw($_POST[$k]));
		}

		$periodos = $_POST['ib_formacao_periodo'] ?? [];
		$cursos = $_POST['ib_formacao_curso'] ?? [];
		$linhas = [];
		foreach ($periodos as $i => $p) {
			$c = $cursos[$i] ?? '';
			if (trim($p) || trim($c)) $linhas[] = trim($p) . '|' . trim($c);
		}
		\update_post_meta($post_id, 'ib_sobre_formacao', implode("\n", $linhas));

		$grupos = array_filter(array_map('trim', $_POST['ib_sobre_grupos'] ?? []));
		\update_post_meta($post_id, 'ib_sobre_grupos', implode("\n", $grupos));
	}

	public static function add_meta_box() {
		$types = ['post', 'page', 'publicacao', 'livro', 'poiesis', 'material'];
		foreach ($types as $t) {
			add_meta_box('ib-seo', 'SEO', [__CLASS__, 'render_meta_box'], $t, 'side', 'default');
		}
	}

	public static function render_meta_box($post) {
		wp_nonce_field('ib_seo_save', 'ib_seo_nonce');
		$title       = get_post_meta($post->ID, '_ib_title', true);
		$description = get_post_meta($post->ID, '_ib_description', true);
		?>
		<p><label for="ib-title" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Título personalizado</label>
		<input type="text" id="ib-title" name="ib_title" value="<?php echo esc_attr($title); ?>" style="width:100%;padding:5px 6px;font-size:12px" placeholder="Deixe vazio para usar o título padrão"></p>
		<p><label for="ib-description" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Meta description</label>
		<textarea id="ib-description" name="ib_description" rows="3" style="width:100%;padding:5px 6px;font-size:12px" placeholder="Resumo para mecanismos de busca (máx. 160 caracteres)"><?php echo esc_textarea($description); ?></textarea>
		<button type="button" class="button" id="ib-gen-desc" data-post-id="<?php echo (int) $post->ID; ?>" style="margin-top:6px;font-size:11px">⚡ Gerar com IA</button>
		<span id="ib-gen-status" style="font-size:11px;color:#999;margin-left:6px"></span></p>
		<script>
		document.getElementById('ib-gen-desc')?.addEventListener('click', function(){
			var btn = this, status = document.getElementById('ib-gen-status');
			btn.disabled = true; status.textContent = 'Gerando…';
			var fd = new FormData();
			fd.append('action', 'ib_gen_editor');
			fd.append('post_id', btn.getAttribute('data-post-id'));
			fd.append('_wpnonce', '<?php echo wp_create_nonce('ib_gen_editor'); ?>');
			fetch('<?php echo admin_url('admin-ajax.php'); ?>', {method:'POST',body:fd})
			.then(function(r){return r.json()})
			.then(function(d){
				if(d.success && d.data.desc){
					document.getElementById('ib-description').value = d.data.desc;
					status.textContent = '✅';
				} else {
					status.textContent = '❌ ' + (d.data || 'Erro');
				}
				btn.disabled = false;
			});
		});
		</script>
		<?php
	}

	public static function ajax_gen_editor() {
		if (!\wp_verify_nonce($_POST['_wpnonce'] ?? '', 'ib_gen_editor')) \wp_die(json_encode(['success' => false, 'data' => 'Falha de segurança.']));
		if (!\current_user_can('edit_pages')) \wp_die(json_encode(['success' => false, 'data' => 'Sem permissão.']));
		$pid = (int) ($_POST['post_id'] ?? 0);
		$post = \get_post($pid);
		if (!$post) \wp_die(json_encode(['success' => false, 'data' => 'Post não encontrado.']));

		\delete_post_meta($pid, '_ib_description');
		$desc = self::generate_description($post);
		if ($desc) {
			\update_post_meta($pid, '_ib_description', $desc);
		}
		\wp_send_json_success(['desc' => $desc]);
	}

	public static function auto_description($post_id, $post) {
		if (\defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (\wp_is_post_revision($post_id) || \wp_is_post_autosave($post_id)) return;
		if (\metadata_exists('post', $post_id, '_ib_description')) return;
		$desc = self::generate_description($post);
		if ($desc) {
			\update_post_meta($post_id, '_ib_description', $desc);
		}
	}

	private static function generate_excerpt($post) {
		if (!empty($post->post_excerpt)) return $post->post_excerpt;
		if (empty($post->post_content)) return '';

		$key = \IrenilsonBarbosa\Core\AdminSettings::opt('deepseek_key');
		if ($key) {
			$ds = self::deepseek_summarize_excerpt($post->post_content, $key);
			if ($ds) return $ds;
		}

		return \wp_trim_words(\wp_strip_all_tags($post->post_content), 30);
	}

	private static function generate_description($post) {
		$content = trim($post->post_content ?? '');

		if ($post->post_type === 'page' && empty($content)) {
			$slug = $post->post_name;
			$arch_map = [
				'artigos' => 'arch_desc_artigos', 'publicacoes' => 'arch_desc_publicacoes',
				'publicação' => 'arch_desc_publicacoes', 'publicacoes-2' => 'arch_desc_publicacoes',
				'livros' => 'arch_desc_livros', 'materiais' => 'arch_desc_materiais',
				'poiesis' => 'arch_desc_poiesis',
			];
			if (isset($arch_map[$slug])) {
				$arch_desc = \IrenilsonBarbosa\Core\AdminSettings::opt($arch_map[$slug]);
				if ($arch_desc) return $arch_desc;
			}
		}

		if (empty($content) && $post->post_type === 'page') {
			$url = \get_permalink($post);
			if ($url) {
				$resp = \wp_remote_get($url, ['timeout' => 10]);
				if (!\is_wp_error($resp)) {
					$html = \wp_remote_retrieve_body($resp);
					$html = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $html);
					$html = preg_replace('/<style[^>]*>.*?<\/style>/is', '', $html);
					$html = preg_replace('/<header[^>]*>.*?<\/header>/is', '', $html);
					$html = preg_replace('/<footer[^>]*>.*?<\/footer>/is', '', $html);
					$html = preg_replace('/<nav[^>]*>.*?<\/nav>/is', '', $html);
					if (preg_match('/<(main|article)[^>]*>.*?<\/(main|article)>/is', $html, $m)) {
						$html = $m[0];
					}
					$html = \wp_strip_all_tags($html);
					$html = trim(preg_replace('/\s+/', ' ', $html));
					$content = \mb_substr($html, 0, 3000);
				}
			}
		}
		if (empty($content) && !empty($post->post_title)) {
			$name = \get_bloginfo('name');
			return $post->post_title . ' — ' . $name . '. Acesse para mais informações.';
		}
		if (empty($content)) return '';

		$key = \IrenilsonBarbosa\Core\AdminSettings::opt('deepseek_key');
		if ($key) {
			$ds = self::deepseek_summarize($content, $key);
			if ($ds) return $ds;
		}

		if (!empty($post->post_excerpt)) return \wp_trim_words($post->post_excerpt, 25);
		return self::local_summarize($content);
	}

	private static function deepseek_summarize_excerpt($content, $key) {
		$text = \wp_strip_all_tags($content);
		$text = \mb_substr($text, 0, 3000);

		$resp = \wp_remote_post('https://api.deepseek.com/chat/completions', [
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $key,
			],
			'body' => \json_encode([
				'model' => 'deepseek-v4-flash',
				'messages' => [
					['role' => 'system', 'content' => 'Resuma o artigo abaixo em 2 a 3 frases (20 a 40 palavras) para ser o resumo (excerpt) do post. Deve despertar interesse e resumir o conteudo de forma atraente. Responda APENAS com o resumo, sem formatacao.'],
					['role' => 'user', 'content' => $text],
				],
				'max_tokens' => 300,
				'temperature' => 0.3,
			]),
			'timeout' => 30,
		]);

		if (\is_wp_error($resp)) return '';
		$body = \json_decode(\wp_remote_retrieve_body($resp), true);
		if (!empty($body['error'])) return '';
		$result = $body['choices'][0]['message']['content'] ?? '';
		return $result ? trim($result) : '';
	}

	private static function deepseek_summarize($content, $key) {
		$text = \wp_strip_all_tags($content);
		$text = \mb_substr($text, 0, 2000);

		$resp = \wp_remote_post('https://api.deepseek.com/chat/completions', [
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $key,
			],
			'body' => \json_encode([
				'model' => 'deepseek-v4-flash',
				'messages' => [
					['role' => 'system', 'content' => 'Gere uma meta description em portugues seguindo boas praticas de SEO: 1) entre 120 e 160 caracteres 2) que desperte curiosidade e clique 3) contenha a palavra-chave principal do artigo 4) seja um resumo atraente e completo em uma ou duas frases 5) nao use aspas, barras ou caracteres especiais no inicio/fim. Responda APENAS com a meta description.'],
					['role' => 'user', 'content' => $text],
				],
				'max_tokens' => 500,
				'temperature' => 0.1,
			]),
			'timeout' => 30,
		]);

		if (\is_wp_error($resp)) return '';
		$body = \json_decode(\wp_remote_retrieve_body($resp), true);
		if (!empty($body['error'])) return '';
		$result = $body['choices'][0]['message']['content'] ?? '';
		return $result ? \mb_substr(trim($result), 0, 160) : '';
	}

	private static function local_summarize($content) {
		$text = \wp_strip_all_tags($content);
		$text = preg_replace('/\s+/', ' ', $text);
		$sentences = preg_split('/(?<=[.!?])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
		foreach ($sentences as $s) {
			$s = trim($s);
			$len = \str_word_count($s);
			if ($len >= 8 && $len < 40) {
				return \mb_substr($s, 0, 160);
			}
		}
		return \wp_trim_words($text, 25);
	}

	public static function cli_batch_seo() {
		if (!\defined('WP_CLI') || !\WP_CLI) return;
		$desc = 0; $excerpt = 0;
		$types = \get_post_types(['public' => true, 'show_ui' => true], 'names');
		$posts = \get_posts(['post_type' => $types, 'post_status' => 'publish', 'posts_per_page' => -1, 'fields' => 'ids']);
		foreach ($posts as $pid) {
			$post = \get_post($pid);
			if (!\get_post_meta($pid, '_ib_description', true)) {
				$d = self::generate_description($post);
				if ($d) { \update_post_meta($pid, '_ib_description', $d); $desc++; }
			}
			if (empty($post->post_excerpt) && !empty($post->post_content)) {
				$ex = self::generate_excerpt($post);
				if ($ex) { \wp_update_post(['ID' => $pid, 'post_excerpt' => $ex]); $excerpt++; }
			}
		}
		\WP_CLI::success("Geradas $desc meta descriptions e $excerpt excerpts.");
	}

	public static function ajax_gen_desc() {
		if (!\wp_verify_nonce($_POST['_wpnonce'] ?? '', 'ib_gen_desc')) \wp_die('Falha de segurança.');
		if (!\current_user_can('edit_pages')) \wp_die('Sem permissão.');
		$pid = (int) ($_POST['post_id'] ?? 0);
		if (!$pid) \wp_die('ID inválido.');
		$post = \get_post($pid);
		if (!$post) \wp_die('Post não encontrado.');

		\delete_post_meta($pid, '_ib_description');
		$desc = self::generate_description($post);
		if ($desc) {
			\update_post_meta($pid, '_ib_description', $desc);
		}
		if (empty($post->post_excerpt) && !empty($post->post_content)) {
			$ex = self::generate_excerpt($post);
			if ($ex) \wp_update_post(['ID' => $pid, 'post_excerpt' => $ex]);
		}
		\wp_redirect(\add_query_arg('page', 'ib-seo-dashboard', \admin_url('admin.php')));
		exit;
	}

	public static function ajax_batch_seo() {
		$nonce = $_POST['_wpnonce'] ?? $_GET['_wpnonce'] ?? '';
		if (!\wp_verify_nonce($nonce, 'ib_batch_seo')) \wp_die('Falha de segurança.');
		if (!\current_user_can('edit_pages')) \wp_die('Sem permissão.');

		$types = \get_post_types(['public' => true, 'show_ui' => true], 'names');
		$posts = \get_posts([
			'post_type' => $types,
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'suppress_filters' => false,
		]);

		$queue = \get_transient('ib_seo_batch_queue');
		if (!$queue) {
			$needed = [];
			foreach ($posts as $pid) {
				$post = \get_post($pid);
				$needs_desc = !\get_post_meta($pid, '_ib_description', true);
				$needs_excerpt = empty($post->post_excerpt) && !empty($post->post_content);
				if ($needs_desc || $needs_excerpt) {
					$needed[] = ['id' => $pid, 'desc' => $needs_desc, 'excerpt' => $needs_excerpt];
				}
			}
			if (empty($needed)) {
				\wp_redirect(\add_query_arg('page', 'ib-seo-dashboard', \admin_url('admin.php')));
				exit;
			}
			\set_transient('ib_seo_batch_queue', $needed, 3600);
			\set_transient('ib_seo_batch_progress', 0, 3600);
			\set_transient('ib_seo_batch_total', count($needed), 3600);
			$queue = $needed;
		}

		$batch = array_splice($queue, 0, 3);
		$remaining = $queue;

		foreach ($batch as $item) {
			$post = \get_post($item['id']);
			if ($item['desc']) {
				\delete_post_meta($item['id'], '_ib_description');
				$desc = self::generate_description($post);
				if ($desc) \update_post_meta($item['id'], '_ib_description', $desc);
			}
			if ($item['excerpt']) {
				$ex = self::generate_excerpt($post);
				if ($ex) \wp_update_post(['ID' => $item['id'], 'post_excerpt' => $ex]);
			}
		}

		$done = (int) \get_transient('ib_seo_batch_progress') + count($batch);
		$total = (int) \get_transient('ib_seo_batch_total');

		if (empty($remaining)) {
			\delete_transient('ib_seo_batch_queue');
			\delete_transient('ib_seo_batch_progress');
			\delete_transient('ib_seo_batch_total');
			\wp_redirect(\add_query_arg(['page' => 'ib-seo-dashboard', 'generated' => $done], \admin_url('admin.php')));
		} else {
			\set_transient('ib_seo_batch_progress', $done, 3600);
			\set_transient('ib_seo_batch_queue', $remaining, 3600);
			\wp_redirect(\add_query_arg(['page' => 'ib-seo-dashboard', 'batch' => 'active', 'done' => $done, 'total' => $total], \admin_url('admin.php')));
		}
		exit;
	}

	public static function save_meta_box($post_id) {
		if (!isset($_POST['ib_seo_nonce']) || !wp_verify_nonce($_POST['ib_seo_nonce'], 'ib_seo_save')) return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_post', $post_id)) return;

		if (isset($_POST['ib_title'])) {
			update_post_meta($post_id, '_ib_title', sanitize_text_field($_POST['ib_title']));
		}
		if (isset($_POST['ib_description'])) {
			$desc = trim($_POST['ib_description']);
			if ($desc) {
				update_post_meta($post_id, '_ib_description', sanitize_textarea_field($desc));
			} else {
				delete_post_meta($post_id, '_ib_description');
			}
		}
	}

	public static function output() {
		if (is_admin() || is_feed() || is_robots() || is_trackback()) return;

		$title = self::get_title();
		$desc  = self::get_description();
		$url   = self::get_url();
		$img   = self::get_image();
		$type  = self::get_og_type();

		echo "\n<!-- SEO — Zucatech Blog Core -->\n";
		?>
<meta name="robots" content="<?php echo esc_attr(self::get_robots()); ?>">
<meta name="description" content="<?php echo esc_attr($desc); ?>">
<link rel="canonical" href="<?php echo esc_url($url); ?>">
<meta property="og:type" content="<?php echo esc_attr($type); ?>">
<meta property="og:title" content="<?php echo esc_attr($title); ?>">
<meta property="og:description" content="<?php echo esc_attr($desc); ?>">
<meta property="og:url" content="<?php echo esc_url($url); ?>">
<meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
<meta property="og:locale" content="pt_BR">
<?php if ($img) : ?>
<meta property="og:image" content="<?php echo esc_url($img); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($desc); ?>">
<?php if ($img) : ?>
<meta name="twitter:image" content="<?php echo esc_url($img); ?>">
<?php endif;
		self::output_schema();
		self::output_breadcrumb_schema();
		self::output_global_schema();
		echo "<!-- /SEO -->\n";
	}

	private static function get_robots() {
		if (is_search() || is_404()) return 'noindex, follow';
		if (is_tag() || is_date() || is_author()) return 'noindex, follow';
		return 'index, follow';
	}

	private static function output_breadcrumb_schema() {
		if (is_front_page() || is_home()) return;
		$items = [];
		$items[] = ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => home_url('/')];

		if (is_singular()) {
			$post = get_queried_object();
			$post_type = $post->post_type;
			$type_labels = [
				'post' => 'Artigos', 'publicacao' => 'Publicações',
				'livro' => 'Livros', 'poiesis' => 'Poiésis', 'material' => 'Materiais',
			];
			if (isset($type_labels[$post_type])) {
				$items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => $type_labels[$post_type], 'item' => get_post_type_archive_link($post_type)];
			}
			if ('post' === $post_type) {
				$cats = get_the_category($post->ID);
				if (!empty($cats) && 'uncategorized' !== strtolower($cats[0]->slug)) {
					$items[] = ['@type' => 'ListItem', 'position' => count($items) + 1, 'name' => $cats[0]->name, 'item' => get_category_link($cats[0]->term_id)];
				}
			}
			$items[] = ['@type' => 'ListItem', 'position' => count($items) + 1, 'name' => get_the_title($post->ID)];
		} elseif (is_category()) {
			$items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => single_cat_title('', false)];
		} elseif (is_post_type_archive()) {
			$pt = get_queried_object();
			$items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => $pt->label ?? ''];
		}

		if (count($items) < 2) return;
		$list = [];
		foreach ($items as $i) {
			$item_url = $i['item'] ?? home_url('/');
			$list[] = '{"@type":"ListItem","position":' . (int)$i['position'] . ',"name":"' . esc_js($i['name']) . '","item":"' . esc_js($item_url) . '"}';
		}
		?><script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[<?php echo implode(',', $list); ?>]}</script><?php
	}

	private static function output_global_schema() {
		$logo = \IrenilsonBarbosa\Core\AdminSettings::opt('site_logo');
		if (!$logo) { $uploads = wp_upload_dir(); $logo = $uploads['baseurl'] . '/2026/07/logo-irenilson.png'; }
		$name = get_bloginfo('name');
		$url  = home_url('/');
		$fb = \IrenilsonBarbosa\Core\AdminSettings::opt('social_facebook') ?: 'https://facebook.com/';
		$ig = \IrenilsonBarbosa\Core\AdminSettings::opt('social_instagram') ?: 'https://instagram.com/';
		$yt = \IrenilsonBarbosa\Core\AdminSettings::opt('social_youtube') ?: 'https://youtube.com/';
		?>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@graph":[
{"@type":"WebSite","name":"<?php echo esc_js($name); ?>","url":"<?php echo esc_js($url); ?>","potentialAction":{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"<?php echo esc_js($url); ?>?s={search_term_string}"},"query-input":"required name=search_term_string"}},
{"@type":"Person","name":"Irenilson Barbosa","url":"<?php echo esc_js(home_url('/sobre/')); ?>","sameAs":["<?php echo esc_js($fb); ?>","<?php echo esc_js($ig); ?>","<?php echo esc_js($yt); ?>"],"jobTitle":"Professor universitário, escritor e pesquisador","description":"Doutor em Educação pela UFBA. Professor Adjunto da UFRB.","knowsAbout":["Educação","Filosofia","Teologia","Poesia","Inclusão"]},
{"@type":"Organization","name":"<?php echo esc_js($name); ?>","url":"<?php echo esc_js($url); ?>","logo":{"@type":"ImageObject","url":"<?php echo esc_js($logo); ?>"},"foundingDate":"2023"}
]
}
</script>
		<?php
	}

	private static function get_url() {
		if (is_singular()) return get_permalink(get_queried_object_id());
		if (is_home() || is_front_page()) return home_url('/');
		if (is_archive()) return get_pagenum_link(1);
		return home_url('/');
	}

	private static function get_og_type() {
		if (is_singular()) {
			$pt = get_post_type();
			if ('livro' === $pt) return 'book';
			return 'article';
		}
		return 'website';
	}

	private static function get_title() {
		if (is_singular()) {
			$custom = get_post_meta(get_queried_object_id(), '_ib_title', true);
			if ($custom) return $custom;
			return single_post_title('', false) . ' — ' . get_bloginfo('name');
		}
		if (is_home() || is_front_page()) {
			return get_bloginfo('name') . ' — Professor universitário, escritor e pesquisador';
		}
		if (is_archive()) {
			$q = get_queried_object();
			if (is_category()) return single_cat_title('', false) . ' — ' . get_bloginfo('name');
			if (is_post_type_archive()) {
				if (is_post_type_archive('publicacao')) return 'Publicações acadêmicas — ' . get_bloginfo('name');
				if (is_post_type_archive('livro')) return 'Livros — ' . get_bloginfo('name');
				if (is_post_type_archive('poiesis')) return 'Poiésis — Poemas — ' . get_bloginfo('name');
				if (is_post_type_archive('material')) return 'Materiais educacionais — ' . get_bloginfo('name');
			}
			return get_the_archive_title() . ' — ' . get_bloginfo('name');
		}
		if (is_search()) {
			return 'Busca: ' . get_search_query() . ' — ' . get_bloginfo('name');
		}
		return wp_get_document_title();
	}

	private static function get_description() {
		$page_descs = [
			'inicio' => 'Portal do Professor Irenilson Barbosa — Ensaios, poemas, publicações acadêmicas, livros e materiais educacionais sobre educação, filosofia, política e cultura.',
			'contato' => 'Entre em contato com o Professor Irenilson Barbosa. Envie sua mensagem, dúvida ou sugestão através do formulário.',
			'privacidade' => 'Política de Privacidade do portal Irenilson Barbosa. Saiba como seus dados são coletados, armazenados e protegidos conforme a LGPD.',
			'sobre' => 'Saiba mais sobre o Professor Irenilson Barbosa — formação acadêmica, atuação profissional, livros publicados e áreas de pesquisa.',
		];

		if (is_singular()) {
			$custom = get_post_meta(get_queried_object_id(), '_ib_description', true);
			if ($custom) return $custom;

			$post = get_queried_object();
			$slug = $post->post_name;
			if (isset($page_descs[$slug])) return $page_descs[$slug];

			if (!empty($post->post_excerpt)) return wp_trim_words($post->post_excerpt, 30);
			if (!empty($post->post_content)) return wp_trim_words(wp_strip_all_tags($post->post_content), 30);
		}
		if (is_home()) {
			$custom = \get_post_meta(\get_queried_object_id(), '_ib_description', true);
			if ($custom) return $custom;
			$arch_desc = \IrenilsonBarbosa\Core\AdminSettings::opt('arch_desc_artigos');
			if ($arch_desc) return $arch_desc;
			return 'Artigos, notícias e reflexões — ' . \get_bloginfo('name');
		}
		if (is_front_page()) {
			return 'Portal do Professor Irenilson Barbosa — Ensaios, poemas, publicações acadêmicas, livros e materiais educacionais sobre educação, filosofia, política e cultura.';
		}
		if (is_archive()) {
			$arch_map = [
				'publicacao' => 'arch_desc_publicacoes',
				'livro' => 'arch_desc_livros',
				'poiesis' => 'arch_desc_poiesis',
				'material' => 'arch_desc_materiais',
			];
			foreach ($arch_map as $pt => $opt) {
				if (is_post_type_archive($pt)) {
					$d = \IrenilsonBarbosa\Core\AdminSettings::opt($opt);
					if ($d) return $d;
				}
			}
			$fallbacks = [
				'publicacao' => 'Publicações acadêmicas de Irenilson Barbosa — artigos científicos, capítulos de livros e ensaios.',
				'livro' => 'Livros de Irenilson Barbosa — obras publicadas sobre educação, inclusão, filosofia e ficção.',
				'poiesis' => 'Poemas e criações literárias de Irenilson Barbosa.',
				'material' => 'Materiais educacionais para download — slides, apostilas e guias.',
			];
			foreach ($fallbacks as $pt => $text) {
				if (is_post_type_archive($pt)) return $text;
			}
			if (is_category()) {
				$desc = category_description();
				if ($desc) return wp_trim_words(wp_strip_all_tags($desc), 30);
				return 'Artigos sobre ' . single_cat_title('', false) . ' — ' . \get_bloginfo('name');
			}
		}
		return '';
	}

	private static function get_image() {
		if (is_singular() || is_front_page()) {
			$post_type = get_post_type();
			if (in_array($post_type, ['post', 'page', 'publicacao', 'livro', 'poiesis', 'material'], true)) {
				$thumb_id = get_post_thumbnail_id(get_queried_object_id());
				if ($thumb_id) {
					$src = wp_get_attachment_image_url($thumb_id, 'large');
					if ($src) return $src;
				}
			}
		}
		$retrato = \IrenilsonBarbosa\Core\AdminSettings::opt('site_logo');
		if ($retrato) return $retrato;
		$uploads = wp_upload_dir();
		return $uploads['baseurl'] . '/2026/07/Irenilson-Barbosa-Retrato.avif';
	}

	private static function output_schema() {
		if (!is_singular()) return;
		$post = get_queried_object();
		if (!$post || empty($post->post_type)) return;

		$post_type = $post->post_type;

		if (in_array($post_type, ['post', 'publicacao', 'poiesis', 'material'], true)) {
			self::schema_article($post);
		} elseif ('livro' === $post_type) {
			self::schema_book($post);
		}
		if ('post' === $post_type) {
			self::schema_faq($post);
		}
	}

	private static function schema_article($post) {
		$title  = self::get_title();
		$desc   = self::get_description();
		$url    = get_permalink($post->ID);
		$img    = self::get_image();
		$author_name = 'Irenilson Barbosa';
		$author_url  = home_url('/sobre/');
		if ('poiesis' === $post->post_type) {
			$a = get_post_meta($post->ID, 'poiesis_author', true);
			if ($a) $author_name = $a;
		}
		$pub  = get_the_date('c', $post->ID);
		$mod  = get_the_modified_date('c', $post->ID);
		$type = 'Article';
		if ('post' === $post->post_type) $type = 'BlogPosting';
		elseif ('publicacao' === $post->post_type) $type = 'ScholarlyArticle';
		elseif ('material' === $post->post_type) $type = 'ScholarlyArticle';
		$cats = $post->post_type === 'post' ? \wp_get_post_categories($post->ID, ['fields' => 'names']) : [];
		$tags = $post->post_type === 'post' ? \wp_get_post_tags($post->ID, ['fields' => 'names']) : [];
		?>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"<?php echo esc_js($type); ?>",
"headline":"<?php echo esc_js($title); ?>",
"description":"<?php echo esc_js($desc); ?>",
"url":"<?php echo esc_js($url); ?>",
"datePublished":"<?php echo esc_js($pub); ?>",
"dateModified":"<?php echo esc_js($mod); ?>",
"author":{"@type":"Person","name":"<?php echo esc_js($author_name); ?>","url":"<?php echo esc_js($author_url); ?>"},
"publisher":{"@type":"Person","name":"Irenilson Barbosa","url":"<?php echo esc_js(home_url('/sobre/')); ?>"},
"mainEntityOfPage":{"@type":"WebPage","@id":"<?php echo esc_js($url); ?>"}
<?php if (!empty($cats)) : ?>,
"articleSection":<?php echo json_encode($cats); ?>
<?php endif; if (!empty($tags)) : ?>,
"keywords":<?php echo json_encode($tags); ?>
<?php endif; if ($img) : ?>,
"image":{"@type":"ImageObject","url":"<?php echo esc_js($img); ?>","width":1200,"height":630}
<?php endif; ?>
}
</script>
		<?php
	}

	public static function sitemap_image($entry, $post) {
		$thumb_id = \get_post_thumbnail_id($post->ID);
		if ($thumb_id) {
			$src = \wp_get_attachment_image_url($thumb_id, 'large');
			if ($src) {
				$entry['images'] = [$src];
			}
		}
		return $entry;
	}

	private static function schema_faq($post) {
		$question = \get_post_meta($post->ID, '_ib_faq_question', true);
		if (!$question) return;
		$answer = \get_post_meta($post->ID, '_ib_faq_answer', true) ?: \get_the_excerpt($post);
		if (!$answer) $answer = \wp_trim_words(\wp_strip_all_tags($post->post_content), 40);
		?>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"FAQPage",
"mainEntity":[{
"@type":"Question",
"name":"<?php echo esc_js($question); ?>",
"acceptedAnswer":{"@type":"Answer","text":"<?php echo esc_js($answer); ?>"}
}]
}
</script>
		<?php
	}

	public static function rss_thumbnail($content) {
		if (!\is_feed()) return $content;
		$post_id = \get_the_ID();
		$thumb = \get_the_post_thumbnail($post_id, 'medium', ['loading' => false]);
		if ($thumb) {
			$content = '<figure>' . $thumb . '</figure>' . $content;
		}
		return $content;
	}

	public static function add_faq_meta_box() {
		\add_meta_box('ib-faq', 'FAQ — Pergunta e Resposta', [__CLASS__, 'render_faq_meta'], 'post', 'side', 'low');
	}

	public static function render_faq_meta($post) {
		\wp_nonce_field('ib_faq_save', 'ib_faq_nonce');
		$question = \get_post_meta($post->ID, '_ib_faq_question', true);
		$answer   = \get_post_meta($post->ID, '_ib_faq_answer', true);
		?>
		<p style="font-size:12px;color:#666">Marque perguntas que este post responde diretamente. Aparece como rich snippet no Google.</p>
		<p><label for="ib-faq-q" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Pergunta</label>
		<input type="text" id="ib-faq-q" name="ib_faq_question" value="<?php echo esc_attr($question); ?>" style="width:100%;padding:5px 6px;font-size:12px" placeholder="Ex: O que é educação inclusiva?"></p>
		<p><label for="ib-faq-a" style="display:block;font-weight:600;margin-bottom:4px;font-size:12px">Resposta (opcional — se vazio, usa o resumo do post)</label>
		<textarea id="ib-faq-a" name="ib_faq_answer" rows="3" style="width:100%;padding:5px 6px;font-size:12px" placeholder="Resposta direta para o rich snippet"><?php echo esc_textarea($answer); ?></textarea></p>
		<?php
	}

	public static function save_faq_meta($post_id) {
		if (!isset($_POST['ib_faq_nonce']) || !\wp_verify_nonce($_POST['ib_faq_nonce'], 'ib_faq_save')) return;
		if (\defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!\current_user_can('edit_post', $post_id)) return;
		\update_post_meta($post_id, '_ib_faq_question', \sanitize_text_field($_POST['ib_faq_question'] ?? ''));
		\update_post_meta($post_id, '_ib_faq_answer', \sanitize_textarea_field($_POST['ib_faq_answer'] ?? ''));
	}

	private static function schema_book($post) {
		$title       = get_the_title($post->ID);
		$desc        = get_post_meta($post->ID, '_ib_description', true) ?: wp_trim_words(wp_strip_all_tags($post->post_content), 30);
		$isbn        = get_post_meta($post->ID, 'isbn', true);
		$pages       = get_post_meta($post->ID, 'numero_paginas', true);
		$publisher   = get_post_meta($post->ID, 'editora', true);
		$year        = get_post_meta($post->ID, 'ano', true);
		$img         = self::get_image();
		?>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"Book",
"name":"<?php echo esc_js($title); ?>",
"description":"<?php echo esc_js($desc); ?>",
"url":"<?php echo esc_js(get_permalink($post->ID)); ?>",
"author":{"@type":"Person","name":"Irenilson Barbosa","url":"<?php echo esc_js(home_url('/sobre/')); ?>"}
<?php if ($isbn) : ?>,
"isbn":"<?php echo esc_js($isbn); ?>"
<?php endif; if ($pages) : ?>,
"numberOfPages":"<?php echo esc_js($pages); ?>"
<?php endif; if ($publisher) : ?>,
"publisher":"<?php echo esc_js($publisher); ?>"
<?php endif; if ($year) : ?>,
"datePublished":"<?php echo esc_js($year); ?>"
<?php endif; if ($img) : ?>,
"image":"<?php echo esc_js($img); ?>"
<?php endif; ?>
}
</script>
		<?php
	}
}
