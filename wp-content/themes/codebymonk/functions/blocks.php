<?php

/**
 * Register Custom ACF Gutenberg Blocks
 *
 * Implements Gutenberg example preview screenshot support (Rule 7)
 */
function register_acf_block_types() {
	$block_names = [
		'hero',
		'clients',
		'portfolio-grid',
		'case-studies-slider',
		'start-story',
		'services',
		'about',
		'blog-grid',
		'cta',
		'side-by-side',
		'cta-label',
		'logo-grid',
		'styleguide',
	];

	foreach ($block_names as $name) {
		$title = ucwords(str_replace(['-', '_'], ' ', $name));

		$block = [
			'name'            => $name,
			'title'           => __($title, 'codebymonk'),
			'description'     => __("Bloque {$title} para CodeByMonk", 'codebymonk'),
			'render_template' => "blocks/{$name}.php",
			'category'        => 'formatting',
			'icon'            => 'layout',
			'keywords'        => [$name, 'codebymonk'],
			'supports'        => [
				'align' => false,
				'mode'  => true,
				'jsx'   => true,
			],
			'example'         => [
				'attributes' => [
					'mode' => 'preview',
					'data' => [
						'is_preview' => true,
					],
				],
			],
		];

		// Modular JS enqueue if present
		$js_path = get_template_directory() . "/assets/js/{$name}.js";
		if (file_exists($js_path)) {
			$block['enqueue_script'] = get_template_directory_uri() . "/assets/js/{$name}.js";
		}

		acf_register_block_type($block);
	}
}

if (function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}
