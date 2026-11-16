<?php
/**
 * Block Template: Side by Side
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

$left_content  = get_field('left_content');
$right_content = get_field('right_content');
$has_bg_img    = get_field('has_background_image');
$bg_image      = get_field('block_background_image');
$bg_url        = is_array($bg_image) ? ($bg_image['url'] ?? '') : ($bg_image ?: '');
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="<?= esc_attr($block_meta['name']); ?>" 
	class="side-by-side-block relative py-16 md:py-24 <?= esc_attr($block_meta['classes']); ?>"
	<?php if ($has_bg_img && !empty($bg_url)) : ?>
		style="background-image: url('<?= esc_url($bg_url); ?>'); background-size: cover; background-position: center;"
	<?php endif; ?>
>
	<div class="container mx-auto px-4 max-w-7xl">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
			<!-- Left Column -->
			<div class="side-column left-column space-y-6">
				<?php if (!empty($left_content['image'])) : 
					$l_img = $left_content['image'];
					$l_url = is_array($l_img) ? ($l_img['url'] ?? '') : $l_img;
					$l_alt = is_array($l_img) ? ($l_img['alt'] ?? 'Left Media') : 'Left Media';
				?>
					<div class="image-content rounded-2xl overflow-hidden shadow-xl">
						<img src="<?= esc_url($l_url); ?>" alt="<?= esc_attr($l_alt); ?>" class="w-full h-auto object-cover" loading="lazy" decoding="async" />
					</div>
				<?php endif; ?>

				<?php if (!empty($left_content['title']) || !empty($left_content['text'])) : ?>
					<div class="text-content space-y-4">
						<?php if (!empty($left_content['title'])) : ?>
							<div class="text-3xl font-bold text-slate-900"><?= wp_kses_post($left_content['title']); ?></div>
						<?php endif; ?>
						<?php if (!empty($left_content['text'])) : ?>
							<div class="text-slate-600 text-lg leading-relaxed"><?= wp_kses_post($left_content['text']); ?></div>
						<?php endif; ?>
						<?php if (!empty($left_content['button']) && is_array($left_content['button'])) : 
							$l_btn = $left_content['button'];
							$l_target = !empty($l_btn['target']) ? $l_btn['target'] : '_self';
						?>
							<div class="pt-2">
								<a href="<?= esc_url($l_btn['url']); ?>" target="<?= esc_attr($l_target); ?>" class="inline-flex items-center px-6 py-3 font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow">
									<?= esc_html($l_btn['title']); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Right Column -->
			<div class="side-column right-column space-y-6">
				<?php if (!empty($right_content['title']) || !empty($right_content['text'])) : ?>
					<div class="text-content space-y-4">
						<?php if (!empty($right_content['title'])) : ?>
							<div class="text-3xl font-bold text-slate-900"><?= wp_kses_post($right_content['title']); ?></div>
						<?php endif; ?>
						<?php if (!empty($right_content['text'])) : ?>
							<div class="text-slate-600 text-lg leading-relaxed"><?= wp_kses_post($right_content['text']); ?></div>
						<?php endif; ?>
						<?php if (!empty($right_content['button']) && is_array($right_content['button'])) : 
							$r_btn = $right_content['button'];
							$r_target = !empty($r_btn['target']) ? $r_btn['target'] : '_self';
						?>
							<div class="pt-2">
								<a href="<?= esc_url($r_btn['url']); ?>" target="<?= esc_attr($r_target); ?>" class="inline-flex items-center px-6 py-3 font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow">
									<?= esc_html($r_btn['title']); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($right_content['image'])) : 
					$r_img = $right_content['image'];
					$r_url = is_array($r_img) ? ($r_img['url'] ?? '') : $r_img;
					$r_alt = is_array($r_img) ? ($r_img['alt'] ?? 'Right Media') : 'Right Media';
				?>
					<div class="image-content rounded-2xl overflow-hidden shadow-xl">
						<img src="<?= esc_url($r_url); ?>" alt="<?= esc_attr($r_alt); ?>" class="w-full h-auto object-cover" loading="lazy" decoding="async" />
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

