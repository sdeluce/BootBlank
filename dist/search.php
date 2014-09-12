<?php get_header(); ?>
<div class="container">
    <?php get_sidebar(); ?>
    	<main role="main">
    		<!-- section -->
    		<section>

    			<h1><?php echo sprintf( __( '%s Search Results for ', 'bootblank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

    			<?php get_template_part('loop'); ?>

    			<?php get_template_part('pagination'); ?>

    		</section>
    		<!-- /section -->
    	</main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
