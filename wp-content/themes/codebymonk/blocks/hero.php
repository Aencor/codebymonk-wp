<?php
/**
 * Block Template: Hero
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 * @var (int|string) $post_id The post ID this block is saved to.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

// Render Gutenberg preview screenshot if in inserter preview
if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title     = get_field('block_title');
$content   = get_field('block_content');
$cta       = get_field('block_cta');
$bg_image  = get_field('block_background_image');
$bg_url    = is_array($bg_image) ? ($bg_image['url'] ?? '') : ($bg_image ?: '');
$bg_alt    = is_array($bg_image) ? ($bg_image['alt'] ?? ($title ?: 'Hero Background')) : ($title ?: 'Hero Background');
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="<?= esc_attr($block_meta['name']); ?>" 
	class="hero-block relative overflow-hidden py-16 md:py-24 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl relative z-10">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
			<div class="lg:col-span-7 space-y-6">
				<?php if (!empty($title)) : ?>
					<h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-tight">
						<?= esc_html($title); ?>
					</h1>
				<?php endif; ?>

				<?php if (!empty($content)) : ?>
					<div class="h-content text-lg sm:text-xl text-slate-600 space-y-4 max-w-2xl leading-relaxed">
						<?= wp_kses_post($content); ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($cta) && is_array($cta)) : 
					$cta_target = !empty($cta['target']) ? $cta['target'] : '_self';
				?>
					<div class="pt-2">
						<a 
							href="<?= esc_url($cta['url']); ?>" 
							target="<?= esc_attr($cta_target); ?>"
							rel="<?= $cta_target === '_blank' ? 'noopener noreferrer' : 'follow'; ?>"
							class="hero-cta inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5"
						>
							<?= esc_html($cta['title']); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($bg_url)) : ?>
				<div class="lg:col-span-5 relative flex justify-center items-center">
					<div class="circle-mask absolute inset-0 bg-blue-100/60 rounded-full filter blur-2xl transform scale-90"></div>
					<div class="hero-image relative z-10 w-full max-w-md mx-auto">
						<img 
							src="<?= esc_url($bg_url); ?>" 
							alt="<?= esc_attr($bg_alt); ?>" 
							class="w-full h-auto rounded-2xl shadow-2xl object-cover"
							loading="eager"
							decoding="async"
						/>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
