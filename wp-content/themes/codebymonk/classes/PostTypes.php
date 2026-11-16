<?php

namespace CodeByMonk;

/**
 * Class PostTypes
 *
 * Registers custom post types: Portfolio and Case Studies.
 */
class PostTypes {

	/**
	 * Initialize hooks.
	 */
	public static function init(): void {
		add_action('init', [__CLASS__, 'register_post_types']);
	}

	/**
	 * Register Custom Post Types for CodeByMonk.
	 */
	public static function register_post_types(): void {
		// 1. Portfolio CPT
		register_post_type('portfolio', [
			'labels' => [
				'name'               => __('Portafolio', 'codebymonk'),
				'singular_name'      => __('Proyecto', 'codebymonk'),
				'add_new'            => __('Añadir Nuevo', 'codebymonk'),
				'add_new_item'       => __('Añadir Nuevo Proyecto', 'codebymonk'),
				'edit_item'          => __('Editar Proyecto', 'codebymonk'),
				'new_item'           => __('Nuevo Proyecto', 'codebymonk'),
				'view_item'          => __('Ver Proyecto', 'codebymonk'),
				'search_items'       => __('Buscar Proyectos', 'codebymonk'),
				'not_found'          => __('No se encontraron proyectos', 'codebymonk'),
				'not_found_in_trash' => __('No hay proyectos en la papelera', 'codebymonk'),
				'menu_name'          => __('Portafolio', 'codebymonk'),
			],
			'public'          => true,
			'has_archive'     => true,
			'show_in_rest'    => true,
			'menu_icon'       => 'dashicons-portfolio',
			'supports'        => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
			'rewrite'         => ['slug' => 'portafolio', 'with_front' => false],
		]);

		// 2. Case Studies CPT
		register_post_type('case_study', [
			'labels' => [
				'name'               => __('Casos de Estudio', 'codebymonk'),
				'singular_name'      => __('Caso de Estudio', 'codebymonk'),
				'add_new'            => __('Añadir Caso', 'codebymonk'),
				'add_new_item'       => __('Añadir Nuevo Caso de Estudio', 'codebymonk'),
				'edit_item'          => __('Editar Caso de Estudio', 'codebymonk'),
				'new_item'           => __('Nuevo Caso de Estudio', 'codebymonk'),
				'view_item'          => __('Ver Caso de Estudio', 'codebymonk'),
				'search_items'       => __('Buscar Casos de Estudio', 'codebymonk'),
				'not_found'          => __('No se encontraron casos de estudio', 'codebymonk'),
				'not_found_in_trash' => __('No hay casos en la papelera', 'codebymonk'),
				'menu_name'          => __('Casos de Estudio', 'codebymonk'),
			],
			'public'          => true,
			'has_archive'     => true,
			'show_in_rest'    => true,
			'menu_icon'       => 'dashicons-analytics',
			'supports'        => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
			'rewrite'         => ['slug' => 'casos-estudio', 'with_front' => false],
		]);
	}
}
