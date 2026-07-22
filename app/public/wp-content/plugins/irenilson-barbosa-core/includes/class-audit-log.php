<?php
namespace IrenilsonBarbosa\Core;

class AuditLog {
	private static $table = 'ib_audit_log';

	public static function init() {
		self::create_table();
		add_action('wp_after_insert_post', [__CLASS__, 'log_post_save'], 10, 4);
		add_action('before_delete_post', [__CLASS__, 'log_post_delete']);
		add_action('wp_trash_post', [__CLASS__, 'log_post_trash']);
		add_action('untrashed_post', [__CLASS__, 'log_post_untrash']);
		add_action('add_attachment', [__CLASS__, 'log_attachment_add']);
		add_action('delete_attachment', [__CLASS__, 'log_attachment_delete']);
		add_action('updated_option', [__CLASS__, 'log_option_change'], 10, 3);
		add_action('wp_login', [__CLASS__, 'log_login'], 10, 2);
		add_action('profile_update', [__CLASS__, 'log_profile_update'], 10, 2);
		add_action('user_register', [__CLASS__, 'log_user_register']);
		add_action('admin_menu', [__CLASS__, 'register_menu']);
		add_action('wp_ajax_ib_export_logs', [__CLASS__, 'ajax_export']);
	}

	public static function log_post_save($post_id, $post, $update, $post_before) {
		try {
			if (wp_is_post_revision($post_id) || wp_is_autosave($post_id)) return;
			if (empty($post) || $post->post_status === 'auto-draft' || $post->post_status === 'trash') return;
			$type = get_post_type($post_id);
			$title = get_the_title($post_id);
			if (! $update) {
				self::log('created', $type, $post_id, $title, "Criou {$type}: {$title}");
				return;
			}
			if (empty($post_before)) {
				self::log('updated', $type, $post_id, $title, "Editou {$type}: {$title}");
				return;
			}
			$changes = [];
			if ($post_before->post_title !== $post->post_title) $changes[] = 'título';
			if ($post_before->post_status !== $post->post_status) $changes[] = "status: {$post->post_status}";
			if ($post_before->post_date !== $post->post_date) $changes[] = 'data';
			if (empty($changes)) $changes[] = 'outros';
			self::log('updated', $type, $post_id, $title, "Editou {$type}: {$title} (" . implode(', ', $changes) . ')');
		} catch (\Throwable $e) {
			error_log('IB AuditLog post_save: ' . $e->getMessage());
		}
	}

	public static function register_menu() {
		add_submenu_page(
			'ib-ajustes',
			'Registro de Alterações',
			'📋 Logs',
			'manage_options',
			'ib-audit-log',
			[__CLASS__, 'render_page']
		);
	}

	public static function create_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . self::$table;
		if (get_option('ib_audit_log_version') === IRENILSON_CORE_VERSION) return;
		$charset = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			user_id bigint(20) unsigned NOT NULL DEFAULT 0,
			user_name varchar(100) NOT NULL DEFAULT '',
			action varchar(50) NOT NULL DEFAULT '',
			object_type varchar(50) NOT NULL DEFAULT '',
			object_id bigint(20) unsigned NOT NULL DEFAULT 0,
			object_title text DEFAULT NULL,
			summary text DEFAULT NULL,
			ip varchar(45) NOT NULL DEFAULT '',
			created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			KEY action (action),
			KEY object_type (object_type),
			KEY user_id (user_id),
			KEY created_at (created_at)
		) $charset;";
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta($sql);
		update_option('ib_audit_log_version', IRENILSON_CORE_VERSION);
	}

	public static function log($action, $object_type, $object_id = 0, $object_title = '', $summary = '') {
		global $wpdb;
		$table = $wpdb->prefix . self::$table;
		$data = [
			'user_id'      => get_current_user_id(),
			'user_name'    => wp_get_current_user()->display_name ?? '',
			'action'       => $action,
			'object_type'  => $object_type,
			'object_id'    => (int) $object_id,
			'object_title' => $object_title ?: '',
			'summary'      => $summary ?: '',
			'ip'           => $_SERVER['REMOTE_ADDR'] ?? '',
		];
		$wpdb->insert($table, $data);
	}

	public static function log_post_delete($post_id) {
		try {
			$type = get_post_type($post_id);
			$title = get_the_title($post_id);
			self::log('deleted', $type, $post_id, $title, "Deletou {$type}: {$title}");
		} catch (\Throwable $e) {}
	}

	public static function log_post_trash($post_id) {
		try {
			$type = get_post_type($post_id);
			$title = get_the_title($post_id);
			self::log('trashed', $type, $post_id, $title, "Moveu {$type} para lixeira: {$title}");
		} catch (\Throwable $e) {}
	}

	public static function log_post_untrash($post_id) {
		try {
			$type = get_post_type($post_id);
			$title = get_the_title($post_id);
			self::log('untrashed', $type, $post_id, $title, "Restaurou {$type} da lixeira: {$title}");
		} catch (\Throwable $e) {}
	}

	public static function log_attachment_add($post_id) {
		try {
			$title = get_the_title($post_id);
			self::log('uploaded', 'attachment', $post_id, $title, "Enviou anexo: {$title}");
		} catch (\Throwable $e) {}
	}

	public static function log_attachment_delete($post_id) {
		try {
			$title = get_the_title($post_id);
			self::log('deleted', 'attachment', $post_id, $title, "Deletou anexo: {$title}");
		} catch (\Throwable $e) {}
	}

	public static function log_option_change($option, $old_value, $value) {
		try {
			$skip = ['_transient', '_site_transient', 'cron', 'rewrite_rules', 'ib_audit_log_version'];
			foreach ($skip as $s) if (strpos($option, $s) !== false) return;
			if (strpos($option, 'ib_opts') !== 0 && strpos($option, 'ib_') !== 0) return;
			self::log('settings_changed', 'option', 0, $option, "Alterou configuração: {$option}");
		} catch (\Throwable $e) {}
	}

	public static function log_login($user_login, $user) {
		try {
			self::log('login', 'user', $user->ID, $user_login, "Login: {$user_login}");
		} catch (\Throwable $e) {}
	}

	public static function log_profile_update($user_id, $old_user_data) {
		try {
			$user = get_userdata($user_id);
			self::log('profile_updated', 'user', $user_id, $user->display_name, "Atualizou perfil: {$user->display_name}");
		} catch (\Throwable $e) {}
	}

	public static function log_user_register($user_id) {
		try {
			$user = get_userdata($user_id);
			self::log('user_registered', 'user', $user_id, $user->display_name, "Novo usuário: {$user->display_name}");
		} catch (\Throwable $e) {}
	}

	public static function render_page() {
		if (!current_user_can('manage_options')) {
			wp_die('Sem permissão.');
		}
		global $wpdb;
		$table = $wpdb->prefix . self::$table;
		$paged = max(1, (int) ($_GET['paged'] ?? 1));
		$per_page = 50;
		$offset = ($paged - 1) * $per_page;
		$order = ($_GET['order'] ?? 'DESC') === 'ASC' ? 'ASC' : 'DESC';
		$where = [];
		if (!empty($_GET['action'])) $where[] = $wpdb->prepare("action = %s", $_GET['action']);
		if (!empty($_GET['user_id'])) $where[] = $wpdb->prepare("user_id = %d", (int) $_GET['user_id']);
		$where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
		$total = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table $where_sql");
		$logs = $wpdb->get_results("SELECT * FROM $table $where_sql ORDER BY created_at $order LIMIT $per_page OFFSET $offset");
		$users = $wpdb->get_results("SELECT DISTINCT user_id, user_name FROM $table WHERE user_id > 0 ORDER BY user_name");
		$total_pages = ceil($total / $per_page);
		?>
		<div class="wrap">
			<h1>📋 Registro de Alterações</h1>
			<form method="get" style="margin:16px 0;display:flex;gap:8px;flex-wrap:wrap;align-items:center">
				<input type="hidden" name="page" value="ib-audit-log">
				<select name="action" style="float:none">
					<option value="">Todas ações</option>
					<?php foreach ($wpdb->get_col("SELECT DISTINCT action FROM $table ORDER BY action") as $a) : ?>
						<option value="<?php echo esc_attr($a); ?>" <?php selected($_GET['action'] ?? '', $a); ?>><?php echo esc_html($a); ?></option>
					<?php endforeach; ?>
				</select>
				<select name="user_id" style="float:none">
					<option value="">Todos usuários</option>
					<?php foreach ($users as $u) : ?>
						<option value="<?php echo (int) $u->user_id; ?>" <?php selected((int) ($_GET['user_id'] ?? 0), (int) $u->user_id); ?>><?php echo esc_html($u->user_name); ?></option>
					<?php endforeach; ?>
				</select>
				<button type="submit" class="button">Filtrar</button>
				<a href="<?php echo esc_url(admin_url('admin.php?page=ib-audit-log')); ?>" class="button">Limpar</a>
				<a href="<?php echo esc_url(admin_url('admin-ajax.php?action=ib_export_logs')); ?>" class="button button-primary" style="margin-left:auto">Exportar CSV</a>
			</form>
			<table class="wp-list-table widefat fixed striped">
				<thead><tr>
					<th style="width:40px">ID</th>
					<th style="width:120px">Data</th>
					<th style="width:120px">Usuário</th>
					<th style="width:100px">Ação</th>
					<th>Tipo</th>
					<th>Resumo</th>
					<th style="width:120px">IP</th>
				</tr></thead>
				<tbody>
				<?php if ($logs) : foreach ($logs as $log) : ?>
					<tr>
						<td><?php echo (int) $log->id; ?></td>
						<td><?php echo esc_html($log->created_at); ?></td>
						<td><?php echo esc_html($log->user_name); ?></td>
						<td><code><?php echo esc_html($log->action); ?></code></td>
						<td><?php echo esc_html($log->object_type); ?></td>
						<td><?php echo esc_html($log->summary); ?></td>
						<td style="font-size:11px;color:#999"><?php echo esc_html($log->ip); ?></td>
					</tr>
				<?php endforeach; else : ?>
					<tr><td colspan="7">Nenhum registro encontrado.</td></tr>
				<?php endif; ?>
				</tbody>
			</table>
			<?php if ($total_pages > 1) : ?>
			<div class="tablenav" style="margin-top:16px">
				<div class="tablenav-pages">
					<?php for ($i = 1; $i <= $total_pages; $i++) : ?>
						<a class="button <?php echo $i === $paged ? 'button-primary' : ''; ?>" href="<?php echo esc_url(add_query_arg('paged', $i)); ?>"><?php echo $i; ?></a>
					<?php endfor; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<style>.wrap select{float:none}</style>
		<?php
	}

	public static function ajax_export() {
		if (!current_user_can('manage_options')) wp_die('Sem permissão.');
		global $wpdb;
		$table = $wpdb->prefix . self::$table;
		$where = [];
		if (!empty($_GET['action'])) $where[] = $wpdb->prepare("action = %s", $_GET['action']);
		if (!empty($_GET['user_id'])) $where[] = $wpdb->prepare("user_id = %d", (int) $_GET['user_id']);
		$where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
		$logs = $wpdb->get_results("SELECT * FROM $table $where_sql ORDER BY created_at DESC");
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=audit-log.csv');
		$out = fopen('php://output', 'w');
		fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
		fputcsv($out, ['ID', 'Data', 'Usuário', 'Ação', 'Tipo', 'Objeto', 'Resumo', 'IP']);
		foreach ($logs as $log) {
			fputcsv($out, [$log->id, $log->created_at, $log->user_name, $log->action, $log->object_type, $log->object_title, $log->summary, $log->ip]);
		}
		fclose($out);
		exit;
	}
}
