<?php
namespace IrenilsonBarbosa\Core;

class Setup {
	public static function init() {
		add_action('init', [__CLASS__, 'register_post_types']);
		add_action('init', [__CLASS__, 'register_taxonomies']);
		add_action('init', [__CLASS__, 'register_meta']);
	}

	public static function register_post_types() {
		// Publicações Acadêmicas
		register_post_type('publicacao', [
			'labels' => [
				'name'          => 'Publicações',
				'singular_name' => 'Publicação',
				'menu_name'     => 'Publicações',
				'add_new_item'  => 'Adicionar Publicação',
				'edit_item'     => 'Editar Publicação',
				'view_item'     => 'Ver Publicação',
				'search_items'  => 'Buscar Publicações',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-media-document',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
			'rewrite'      => ['slug' => 'publicacoes'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);

		// Livros
		register_post_type('livro', [
			'labels' => [
				'name'          => 'Livros',
				'singular_name' => 'Livro',
				'menu_name'     => 'Livros',
				'add_new_item'  => 'Adicionar Livro',
				'edit_item'     => 'Editar Livro',
				'view_item'     => 'Ver Livro',
				'search_items'  => 'Buscar Livros',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-book',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
			'rewrite'      => ['slug' => 'livros'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);

		// Materiais
		register_post_type('material', [
			'labels' => [
				'name'          => 'Materiais',
				'singular_name' => 'Material',
				'menu_name'     => 'Materiais',
				'add_new_item'  => 'Adicionar Material',
				'edit_item'     => 'Editar Material',
				'view_item'     => 'Ver Material',
				'search_items'  => 'Buscar Materiais',
			],
			'public'       => true,
			'menu_icon'    => 'dashicons-download',
			'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
			'rewrite'      => ['slug' => 'materiais'],
			'has_archive'  => true,
			'show_in_rest' => true,
		]);
	}

	public static function register_taxonomies() {
		// Tipo de Publicação (hierárquica)
		register_taxonomy('tipo-de-publicacao', 'publicacao', [
			'labels' => [
				'name'          => 'Tipos de Publicação',
				'singular_name' => 'Tipo de Publicação',
				'menu_name'     => 'Tipos',
				'add_new_item'  => 'Adicionar Tipo',
				'edit_item'     => 'Editar Tipo',
			],
			'hierarchical' => true,
			'rewrite'      => ['slug' => 'tipo'],
			'show_in_rest' => true,
		]);

		// Participação no Livro (hierárquica)
		register_taxonomy('participacao', 'livro', [
			'labels' => [
				'name'          => 'Participações',
				'singular_name' => 'Participação',
				'menu_name'     => 'Participação',
				'add_new_item'  => 'Adicionar Tipo',
				'edit_item'     => 'Editar Tipo',
			],
			'hierarchical' => true,
			'rewrite'      => ['slug' => 'participacao'],
			'show_in_rest' => true,
		]);

		// Tipo de Material (hierárquica)
		register_taxonomy('tipo-de-material', 'material', [
			'labels' => [
				'name'          => 'Tipos de Material',
				'singular_name' => 'Tipo de Material',
				'menu_name'     => 'Tipos',
				'add_new_item'  => 'Adicionar Tipo',
				'edit_item'     => 'Editar Tipo',
			],
			'hierarchical' => true,
			'rewrite'      => ['slug' => 'tipo-material'],
			'show_in_rest' => true,
		]);
	}

	public static function register_meta() {
		$meta_fields = [
			'subtitulo'        => ['type' => 'string', 'post_types' => ['post']],
			'tempo_leitura'    => ['type' => 'integer', 'post_types' => ['post']],
			'destaque_tipo'    => ['type' => 'string', 'post_types' => ['post']],
			'ano_publicacao'   => ['type' => 'integer', 'post_types' => ['publicacao']],
			'periodico'        => ['type' => 'string', 'post_types' => ['publicacao']],
			'doi'              => ['type' => 'string', 'post_types' => ['publicacao']],
			'link_externo'     => ['type' => 'string', 'post_types' => ['publicacao']],
			'citacao_abnt'     => ['type' => 'string', 'post_types' => ['publicacao']],
			'isbn'             => ['type' => 'string', 'post_types' => ['livro']],
			'ano'              => ['type' => 'integer', 'post_types' => ['livro', 'material']],
			'editora'          => ['type' => 'string', 'post_types' => ['livro']],
			'sinopse'          => ['type' => 'string', 'post_types' => ['livro']],
			'numero_paginas'   => ['type' => 'integer', 'post_types' => ['livro']],
			'link_amazon'      => ['type' => 'string', 'post_types' => ['livro']],
			'link_marinete'    => ['type' => 'string', 'post_types' => ['livro']],
			'descricao'        => ['type' => 'string', 'post_types' => ['material']],
		];

		foreach ($meta_fields as $key => $config) {
			foreach ((array) $config['post_types'] as $post_type) {
				register_post_meta($post_type, $key, [
					'show_in_rest' => true,
					'single'       => true,
					'type'         => $config['type'],
					'auth_callback' => function () { return current_user_can('edit_posts'); },
				]);
			}
		}
	}
}
