<?php get_header(); ?>

	<main role="main" class="<?php bootblank_main_class(); ?>">
		<!-- section -->
		<section>

			<h1><?php _e( 'Latest Posts', 'bootblank' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>