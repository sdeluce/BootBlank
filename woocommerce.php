<?php get_header(); ?>
<div class="container">
	<?php get_sidebar(); ?>
		<main role="main" class="<?php bootblank_main_class(); ?>">
			<!-- section -->
			<section>

				<h1><?php the_title(); ?></h1>

				<?php woocommerce_content(); ?>

			</section>
			<!-- /section -->
		</main>

	<?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
