<?php
/**
 * Block Template: Blog Grid / Articles
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('blog_title') ?: 'Artículos & Reflexiones Técnicas';
$lead  = get_field('blog_lead') ?: 'Publicaciones sobre ingeniería frontend, arquitectura de bloques en WordPress, optimización de rendimiento y diseño con propósito.';

$posts_query = new \WP_Query([
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
]);
?>

<section 
	id="articulos" 
	data-block="blog-grid" 
	class="blog-grid-block py-24 bg-slate-950 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<!-- Section Header -->
		<div class="max-w-3xl mb-16 space-y-4">
			<div class="text-xs uppercase tracking-widest text-blue-400 font-mono font-medium">Conocimiento Compartido</div>
			<h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white"><?= esc_html($title); ?></h2>
			<p class="text-base sm:text-lg text-slate-400 leading-relaxed"><?= esc_html($lead); ?></p>
		</div>

		<?php if ($posts_query->have_posts()) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php while ($posts_query->have_posts()) : $posts_query->the_post(); 
					$thumb_id = get_post_thumbnail_id();
					$img_url  = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'medium_large') : '';
				?>
					<article class="group rounded-2xl border border-slate-800/80 bg-slate-900/40 hover:border-slate-700 hover:bg-slate-900/80 transition-all duration-300 flex flex-col overflow-hidden shadow-lg">
						<!-- Post Thumbnail -->
						<a href="<?php the_permalink(); ?>" class="aspect-video overflow-hidden bg-slate-800 block relative">
							<?php if (!empty($img_url)) : ?>
								<img 
									src="<?= esc_url($img_url); ?>" 
									alt="<?= esc_attr(get_the_title()); ?>" 
									class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
									loading="lazy" 
									decoding="async" 
								/>
							<?php else : ?>
								<div class="w-full h-full flex items-center justify-center font-mono text-slate-500 text-sm">
									CodeByMonk
								</div>
							<?php endif; ?>
						</a>

						<!-- Post Meta & Details -->
						<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
							<div class="space-y-3">
								<div class="text-xs font-mono text-slate-500">
									<time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F, Y'); ?></time>
								</div>
								<h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors leading-snug">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>
								<p class="text-sm text-slate-400 line-clamp-3 leading-relaxed">
									<?php echo wp_strip_all_tags(get_the_excerpt()); ?>
								</p>
							</div>

							<div class="pt-2">
								<a href="<?php the_permalink(); ?>" class="text-sm font-semibold text-blue-400 hover:text-blue-300 inline-flex items-center gap-1.5 transition-colors">
									<span>Leer Artículo</span>
									<span>&rarr;</span>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
