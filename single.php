<?php get_header(); ?>
<div class="container">
	<?php get_sidebar(); ?>
		<main class="<?php bootblank_main_class(); ?>" role="main">
			<!-- section -->
			<section itemscope itemtype="http://schema.org/Article" >

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article itemprop="articleBody" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
									$thumb_id = get_post_thumbnail_id();
									$thumb_url = wp_get_attachment_image_src($thumb_id,'small', true);
									$img = $thumb_url[0];
								?>
								<img itemprop="image" class="img-responsive" itemprop="thumbnailUrl"  src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post title -->
					<h1>
						<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span itemprop="headline"><?php the_title(); ?></span></a>
					</h1>
					<!-- /post title -->

					<!-- post details -->
					<p>
						<span class="date"><span itemprop="datePublished"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span></span>
						<span class="author"><?php _e( 'Published by', 'bootblank' ); ?> <span itemprop="author"><?php the_author_posts_link(); ?></span></span>
						<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'bootblank' ), __( '1 Comment', 'bootblank' ), __( '% Comments', 'bootblank' )); ?></span>
					</p>
					<!-- /post details -->

					<?php the_content(); // Dynamic Content ?>

					<span itemprop="keywords" ><?php the_tags( __( 'Tags: ', 'bootblank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?></span>

					<p><?php _e( 'Categorised in: ', 'bootblank' ). " <span itemprop='genre' >".the_category(', ')."</span>"; // Separated by commas ?></p>

					<p><?php _e( 'This post was written by ', 'bootblank' ); the_author(); ?></p>

					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

					<?php comments_template(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h1><?php _e( 'Sorry, nothing to display.', 'bootblank' ); ?></h1>

				</article>
				<!-- /article -->

			<?php endif; ?>

			</section>
			<!-- /section -->
		</main>

	<?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
