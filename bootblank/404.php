<?php get_header(); ?>
<div class="container">
	<?php get_sidebar(); ?>

		<main class="<?php bootblank_main_class(); ?>" role="main">
			<!-- section -->
			<section>

				<!-- article -->
				<article id="post-404">

					<h1><?php _e( 'Page not found', 'bootblank' ); ?></h1>
					<h2>
						<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'bootblank' ); ?></a>
					</h2>

				</article>
				<!-- /article -->

			</section>
			<!-- /section -->
		</main>

	<?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
