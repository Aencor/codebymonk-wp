<?php
/**
 * Main Template File
 *
 * 100% Dynamic - Renders WordPress loop / Gutenberg blocks (Rule 4)
 */

get_header(); ?>

<main id="primary" class="site-main global-main min-h-screen">
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
	else :
		?>
		<div class="container mx-auto px-4 py-16 text-center">
			<h1 class="text-3xl font-bold mb-4 text-slate-800"><?php esc_html_e('No hay contenido disponible', 'codebymonk'); ?></h1>
			<p class="text-slate-600"><?php esc_html_e('La página solicitada no contiene bloques o publicaciones activas.', 'codebymonk'); ?></p>
		</div>
		<?php
	endif;
	?>
</main>

<?php get_footer(); ?>
