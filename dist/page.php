<?php get_header(); ?>
<div class="container">
	<?php get_sidebar(); ?>

		<main class="<?php bootblank_main_class(); ?>" role="main">
			<!-- section -->
			<section itemscope itemtype="http://schema.org/WebPage">

				<h1 itemprop="headline"><?php the_title(); ?></h1>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article itemprop="contentLocation" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>

					<?php comments_template( '', true ); // Remove if you don't want comments ?>

					<br class="clear">

					<?php edit_post_link(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h2><?php _e( 'Sorry, nothing to display.', 'bootblank' ); ?></h2>

				</article>
				<!-- /article -->

			<?php endif; ?>

			</section>
			<!-- /section -->
		</main>

	<?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
