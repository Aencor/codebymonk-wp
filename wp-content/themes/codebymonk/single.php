<?php
/**
 * The template for displaying all single posts
 *
 * @package codebymonk
 */

get_header(); ?>

<main id="primary" class="site-main py-16 sm:py-24 min-h-screen bg-slate-950 text-slate-100">
	<div class="container mx-auto px-4 max-w-4xl">
		<?php
		while (have_posts()) :
			the_post();
			$thumb_id = get_post_thumbnail_id();
			$img_url  = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('space-y-8'); ?>>
				<!-- Header info -->
				<header class="space-y-4 text-center max-w-3xl mx-auto">
					<div class="inline-flex items-center gap-2 text-xs font-mono text-blue-400 uppercase tracking-widest">
						<time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F, Y'); ?></time>
						<span>&bull;</span>
						<span>CodeByMonk</span>
					</div>

					<h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
						<?php the_title(); ?>
					</h1>

					<?php if (has_excerpt()) : ?>
						<p class="text-lg text-slate-400 font-light leading-relaxed">
							<?php echo get_the_excerpt(); ?>
						</p>
					<?php endif; ?>
				</header>

				<!-- Featured Image -->
				<?php if (!empty($img_url)) : ?>
					<div class="rounded-3xl overflow-hidden border border-slate-800 shadow-2xl aspect-video bg-slate-900">
						<img 
							src="<?= esc_url($img_url); ?>" 
							alt="<?= esc_attr(get_the_title()); ?>" 
							class="w-full h-full object-cover" 
							loading="eager" 
							decoding="async" 
						/>
					</div>
				<?php endif; ?>

				<!-- Entry Content -->
				<div class="entry-content prose prose-invert prose-lg max-w-none pt-6 space-y-6 text-slate-300 leading-relaxed font-light">
					<?php the_content(); ?>
				</div>

				<!-- Post Footer / Navigation -->
				<footer class="pt-12 border-t border-slate-800/80 flex items-center justify-between">
					<a href="<?php echo esc_url(home_url('/')); ?>#articulos" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors">
						&larr; Volver a Todos los Artículos
					</a>
					<a href="<?php echo esc_url(home_url('/')); ?>#contacto" class="text-sm font-semibold text-white hover:text-blue-400 transition-colors">
						Hablemos &rarr;
					</a>
				</footer>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>

<?php get_footer(); ?>

