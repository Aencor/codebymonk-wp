<?php
/**
 * Block Template: Case Studies Slider / Deep-Dives
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('cases_title') ?: 'Casos de Estudio en Profundidad';
$lead  = get_field('cases_lead') ?: 'Análisis detallado de cómo transformamos plataformas lentas y complejas en soluciones ágiles, seguras y altamente rentables.';

$case_studies = new \WP_Query([
	'post_type'      => 'case_study',
	'post_status'    => 'publish',
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
]);
?>

<section 
	id="casos-de-estudio" 
	data-block="case-studies-slider" 
	class="case-studies-block py-24 bg-slate-900/60 border-t border-slate-900 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<!-- Section Header -->
		<div class="max-w-3xl mb-16 space-y-4">
			<div class="text-xs uppercase tracking-widest text-emerald-400 font-mono font-medium">Impacto y Resultados</div>
			<h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white"><?= esc_html($title); ?></h2>
			<p class="text-base sm:text-lg text-slate-400 leading-relaxed"><?= esc_html($lead); ?></p>
		</div>

		<?php if ($case_studies->have_posts()) : ?>
			<div class="space-y-16">
				<?php while ($case_studies->have_posts()) : $case_studies->the_post(); 
					$meta        = get_post_meta(get_the_ID());
					$client      = $meta['project_client'][0] ?? get_the_title();
					$year        = $meta['project_year'][0] ?? '2026';
					$url         = $meta['project_url'][0] ?? '';
					$was_there   = $meta['what_was_there'][0] ?? '';
					$what_did    = $meta['what_i_did'][0] ?? '';
					$how_did     = $meta['how_i_did_it'][0] ?? '';
					$results     = $meta['results_achieved'][0] ?? '';
					$thumb_id    = get_post_thumbnail_id();
					$img_url     = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
				?>
					<div class="rounded-3xl border border-slate-800 bg-slate-950 p-6 sm:p-10 lg:p-12 shadow-2xl space-y-8">
						<!-- Case Study Top Info -->
						<div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 border-b border-slate-800/80 pb-6">
							<div class="space-y-1">
								<div class="text-xs uppercase font-mono tracking-wider text-blue-400">
									<?= esc_html($client); ?> &bull; <?= esc_html($year); ?>
								</div>
								<h3 class="text-2xl sm:text-3xl font-extrabold text-white">
									<?= esc_html(get_the_title()); ?>
								</h3>
							</div>

							<?php if (!empty($url)) : ?>
								<a 
									href="<?= esc_url($url); ?>" 
									target="_blank" 
									rel="noopener noreferrer" 
									class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600/10 hover:bg-blue-600/20 text-blue-400 text-sm font-semibold border border-blue-500/30 transition-colors"
								>
									<span>Ver Proyecto Online</span>
									<span>&rarr;</span>
								</a>
							<?php endif; ?>
						</div>

						<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
							<!-- Media / Screenshot -->
							<?php if (!empty($img_url)) : ?>
								<div class="lg:col-span-5 rounded-2xl overflow-hidden border border-slate-800 shadow-xl bg-slate-900">
									<img 
										src="<?= esc_url($img_url); ?>" 
										alt="<?= esc_attr(get_the_title()); ?>" 
										class="w-full h-auto object-cover object-top hover:scale-105 transition-transform duration-700" 
										loading="lazy" 
										decoding="async" 
									/>
								</div>
							<?php endif; ?>

							<!-- Detailed Points -->
							<div class="<?= !empty($img_url) ? 'lg:col-span-7' : 'lg:col-span-12'; ?> space-y-6">
								<?php if (!empty($was_there)) : ?>
									<div class="space-y-2">
										<h4 class="text-xs uppercase font-mono tracking-wider text-rose-400 font-bold">1. El Punto de Partida</h4>
										<p class="text-sm sm:text-base text-slate-300 leading-relaxed"><?= nl2br(esc_html($was_there)); ?></p>
									</div>
								<?php endif; ?>

								<?php if (!empty($what_did)) : ?>
									<div class="space-y-2">
										<h4 class="text-xs uppercase font-mono tracking-wider text-blue-400 font-bold">2. La Solución Estratégica</h4>
										<p class="text-sm sm:text-base text-slate-300 leading-relaxed"><?= nl2br(esc_html($what_did)); ?></p>
									</div>
								<?php endif; ?>

								<?php if (!empty($how_did)) : ?>
									<div class="space-y-2">
										<h4 class="text-xs uppercase font-mono tracking-wider text-amber-400 font-bold">3. Implementación Técnica</h4>
										<div class="text-sm text-slate-400 leading-relaxed space-y-1.5"><?= nl2br(esc_html($how_did)); ?></div>
									</div>
								<?php endif; ?>

								<?php if (!empty($results)) : ?>
									<div class="p-5 rounded-2xl bg-emerald-950/30 border border-emerald-500/30 space-y-2">
										<h4 class="text-xs uppercase font-mono tracking-wider text-emerald-400 font-bold">4. Resultados Conseguidos</h4>
										<div class="text-sm text-emerald-200/90 leading-relaxed"><?= nl2br(esc_html($results)); ?></div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

