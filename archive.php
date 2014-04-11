<?php get_header(); ?>

	<main role="main" class="col-md-9">
		<!-- section -->
		<section>

			<h1><?php _e( 'Archives', 'bootblank' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
