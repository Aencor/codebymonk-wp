<?php
/**
 * The template for displaying all pages
 *
 * @package codebymonk
 */

get_header(); ?>

<main id="primary" class="site-main global-main min-h-screen">
	<?php
	while (have_posts()) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>

<?php get_footer(); ?>
