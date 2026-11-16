<?php

namespace CodeByMonk;

/**
 * Class BlockHelper
 *
 * Provides DRY utility methods for ACF Gutenberg blocks:
 * - Common ID and Class generation
 * - Padding, margin, and background extraction
 * - Gutenberg Block Preview / Inserter handling (Rule 7)
 */
class BlockHelper {

	/**
	 * Setup and return block attributes, classes, and preview state.
	 *
	 * @param array $block The block settings and attributes.
	 * @param bool  $is_preview True during AJAX preview or inserter render.
	 * @return array
	 */
	public static function setup(array $block, bool $is_preview = false): array {
		$block_name = str_replace('acf/', '', $block['name'] ?? 'custom-block');
		$custom_id  = get_field('block_id');
		$block_id   = !empty($custom_id) ? sanitize_title($custom_id) : ($block['id'] ?? uniqid($block_name . '-'));

		$classes = [
			'block-' . $block_name,
		];

		if (!empty($block['className'])) {
			$classes[] = $block['className'];
		}

		if (!empty($block['align'])) {
			$classes[] = 'align' . $block['align'];
		}

		// Background
		$block_bg = get_field('block_background');
		if (!empty($block_bg)) {
			$classes[] = 'bg-' . esc_attr($block_bg);
		}

		// Padding
		$padding = get_field('padding_options');
		if (is_array($padding)) {
			if (!empty($padding['padding_top'])) {
				$classes[] = 'pt-' . esc_attr($padding['padding_top']);
			}
			if (!empty($padding['padding_bottom'])) {
				$classes[] = 'pb-' . esc_attr($padding['padding_bottom']);
			}
		}

		// Margin
		$margin = get_field('margin_options');
		if (is_array($margin)) {
			if (!empty($margin['margin_top'])) {
				$classes[] = 'mt-' . esc_attr($margin['margin_top']);
			}
			if (!empty($margin['margin_bottom'])) {
				$classes[] = 'mb-' . esc_attr($margin['margin_bottom']);
			}
		}

		// Check if rendering as a Gutenberg inserter preview
		$preview_image = get_template_directory_uri() . '/assets/img/blocks/' . $block_name . '.png';
		$preview_path  = get_template_directory() . '/assets/img/blocks/' . $block_name . '.png';
		$has_preview   = file_exists($preview_path);
		$in_preview    = $is_preview && (!empty($block['data']['is_preview']) || empty(array_filter((array) get_fields())));

		return [
			'id'            => $block_id,
			'name'          => $block_name,
			'classes'       => implode(' ', array_unique($classes)),
			'is_preview'    => $in_preview,
			'preview_image' => $preview_image,
			'has_preview'   => $has_preview,
		];
	}

	/**
	 * Check and render screenshot preview in the Gutenberg inserter/editor.
	 *
	 * @param array $block_meta Array returned by self::setup()
	 * @return bool True if preview was rendered, false otherwise.
	 */
	public static function render_preview_if_needed(array $block_meta): bool {
		if ($block_meta['is_preview'] && $block_meta['has_preview']) {
			echo '<div class="acf-block-preview-wrapper text-center p-4 border border-dashed border-slate-400 bg-slate-900 rounded-lg overflow-hidden">';
			echo '<p class="text-xs uppercase tracking-wider text-slate-400 mb-2 font-mono">Vista Previa: ' . esc_html(ucwords(str_replace(['-', '_'], ' ', $block_meta['name']))) . '</p>';
			echo '<img src="' . esc_url($block_meta['preview_image']) . '" alt="' . esc_attr($block_meta['name']) . ' preview" class="w-full max-w-2xl mx-auto rounded shadow-lg object-cover" loading="lazy" />';
			echo '</div>';
			return true;
		}

		return false;
	}
}

