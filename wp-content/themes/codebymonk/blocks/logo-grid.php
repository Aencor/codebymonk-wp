<?php
/**
 * Block Template: Logo Grid
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

$title = get_field('block_title');
$cta   = get_field('block_cta');
$logos = get_field('logos');
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="<?= esc_attr($block_meta['name']); ?>" 
	class="logo-grid-block py-16 md:py-20 bg-slate-50 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<?php if (!empty($title)) : ?>
			<div class="text-center mb-12">
				<h2 class="grid-title text-3xl font-bold tracking-tight text-slate-900"><?= esc_html($title); ?></h2>
			</div>
		<?php endif; ?>

		<?php if (!empty($logos) && is_array($logos)) : ?>
			<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center justify-items-center">
				<?php foreach ($logos as $item) : 
					$logo_data = $item['logo'] ?? null;
					$logo_url  = is_array($logo_data) ? ($logo_data['url'] ?? '') : $logo_data;
					$logo_alt  = is_array($logo_data) ? ($logo_data['alt'] ?? 'Partner Logo') : 'Partner Logo';
				?>
					<?php if (!empty($logo_url)) : ?>
						<div class="grid-item p-4 grayscale hover:grayscale-0 transition-all duration-300 transform hover:scale-105">
							<img src="<?= esc_url($logo_url); ?>" alt="<?= esc_attr($logo_alt); ?>" class="max-h-12 w-auto object-contain" loading="lazy" decoding="async" />
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($cta) && is_array($cta)) : 
			$target = !empty($cta['target']) ? $cta['target'] : '_self';
		?>
			<div class="grid-cta text-center mt-12">
				<a 
					href="<?= esc_url($cta['url']); ?>" 
					target="<?= esc_attr($target); ?>"
					rel="<?= $target === '_blank' ? 'noopener noreferrer' : 'follow'; ?>"
					class="inline-flex items-center px-6 py-3 text-base font-semibold text-blue-600 hover:text-blue-800 transition-colors"
				>
					<?= esc_html($cta['title']); ?> &rarr;
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

