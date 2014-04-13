<?php get_header(); ?>
<?php get_sidebar('left'); ?>
	<main role="main" class="<?php bootblank_main_class(); ?>">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

			<?php woocommerce_content(); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
