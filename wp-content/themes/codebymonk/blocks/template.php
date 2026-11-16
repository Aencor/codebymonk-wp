<?php
/**
 * Block Template: Boilerplate
 *
 * Use this starter template when creating new ACF Gutenberg blocks.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 * @var (int|string) $post_id The post ID this block is saved to.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

// Gutenberg Inserter Preview Support (Rule 7)
if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="<?= esc_attr($block_meta['name']); ?>" 
	class="<?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<!-- Dynamic Block content goes here -->
	</div>
</section>
