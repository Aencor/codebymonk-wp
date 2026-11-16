<?php
/**
 * Block Template: Portfolio Grid
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('portfolio_title') ?: 'Proyectos Seleccionados';
$lead  = get_field('portfolio_lead') ?: 'Una selección de plataformas web construidas con código limpio, arquitectura modular y enfoque absoluto en resultados.';

$projects = new \WP_Query([
	'post_type'      => 'portfolio',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'orderby'        => ['menu_order' => 'ASC', 'date' => 'DESC'],
]);
?>

<section 
	id="proyectos" 
	data-block="portfolio-grid" 
	class="portfolio-grid-block py-24 bg-slate-950 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<!-- Section Header -->
		<div class="max-w-3xl mb-16 space-y-4">
			<div class="text-xs uppercase tracking-widest text-blue-400 font-mono font-medium">Trabajo Destacado</div>
			<h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white"><?= esc_html($title); ?></h2>
			<p class="text-base sm:text-lg text-slate-400 leading-relaxed"><?= esc_html($lead); ?></p>
		</div>

		<?php if ($projects->have_posts()) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php while ($projects->have_posts()) : $projects->the_post(); 
					$meta        = get_post_meta(get_the_ID());
					$client      = $meta['project_client'][0] ?? get_the_title();
					$year        = $meta['project_year'][0] ?? '2026';
					$desc        = $meta['project_description'][0] ?? get_the_excerpt();
					$result      = $meta['project_result'][0] ?? '';
					$url         = $meta['project_url'][0] ?? '';
					$thumb_id    = get_post_thumbnail_id();
					$img_url     = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
				?>
					<article class="group rounded-2xl border border-slate-800/80 bg-slate-900/40 hover:border-blue-500/50 hover:bg-slate-900/80 transition-all duration-300 flex flex-col overflow-hidden shadow-lg hover:shadow-2xl hover:shadow-blue-500/10">
						<!-- Project Media Container -->
						<div class="relative aspect-video overflow-hidden bg-slate-800">
							<?php if (!empty($img_url)) : ?>
								<img 
									src="<?= esc_url($img_url); ?>" 
									alt="<?= esc_attr(get_the_title()); ?>" 
									class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" 
									loading="lazy" 
									decoding="async" 
								/>
							<?php else : ?>
								<div class="w-full h-full flex items-center justify-center font-mono text-slate-500 text-sm">
									[ <?= esc_html(get_the_title()); ?> ]
								</div>
							<?php endif; ?>
							
							<div class="absolute top-3 right-3 px-2.5 py-1 rounded-md bg-slate-950/80 backdrop-blur-sm text-xs font-mono text-slate-300 border border-slate-700/50">
								<?= esc_html($year); ?>
							</div>
						</div>

						<!-- Project Content -->
						<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
							<div class="space-y-2">
								<div class="text-xs uppercase font-mono tracking-wider text-blue-400">
									<?= esc_html($client); ?>
								</div>
								<h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors">
									<?= esc_html(get_the_title()); ?>
								</h3>
								<p class="text-sm text-slate-400 line-clamp-3 leading-relaxed">
									<?= esc_html($desc); ?>
								</p>
							</div>

							<?php if (!empty($result)) : ?>
								<div class="pt-3 border-t border-slate-800/60 text-xs text-emerald-400 font-medium">
									&bull; <?= esc_html(wp_trim_words($result, 14, '...')); ?>
								</div>
							<?php endif; ?>

							<?php if (!empty($url)) : ?>
								<div class="pt-2">
									<a 
										href="<?= esc_url($url); ?>" 
										target="_blank" 
										rel="noopener noreferrer" 
										class="inline-flex items-center text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors gap-1.5"
									>
										<span>Visitar Sitio Web</span>
										<span>&rarr;</span>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
