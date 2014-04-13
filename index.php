<?php get_header(); ?>
<?php get_sidebar('left'); ?>
	<div class="<?php bootblank_main_class(); ?>">
		<!-- section -->
		<section>

			<h1><?php _e( 'Latest Posts', 'bootblank' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
