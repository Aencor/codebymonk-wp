<?php
/**
 * Block Template: CTA Label
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 * @var (int|string) $post_id The post ID this block is saved to.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$cta_text = get_field('cta_text');
$cta      = get_field('cta');
$stacked  = get_field('stacked');
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="<?= esc_attr($block_meta['name']); ?>" 
	class="cta-label-block py-12 md:py-16 bg-slate-900 text-white <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<div class="flex <?= $stacked ? 'flex-col text-center space-y-6' : 'flex-col md:flex-row items-center justify-between gap-8'; ?>">
			<?php if (!empty($cta_text)) : ?>
				<div class="cta-text text-2xl md:text-3xl font-bold tracking-tight">
					<?= nl2br(esc_html($cta_text)); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($cta) && is_array($cta)) : 
				$target = !empty($cta['target']) ? $cta['target'] : '_self';
			?>
				<div class="cta-action shrink-0">
					<a 
						href="<?= esc_url($cta['url']); ?>" 
						target="<?= esc_attr($target); ?>"
						rel="<?= $target === '_blank' ? 'noopener noreferrer' : 'follow'; ?>"
						class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-slate-900 bg-amber-400 hover:bg-amber-300 rounded-xl shadow-lg transition-all duration-200"
					>
						<?= esc_html($cta['title']); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

