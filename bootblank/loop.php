<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article itemprop="articleBody" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php
					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id,'small', true);
					$img = $thumb_url[0];
				?>
				<img itemprop="thumbnailUrl"  src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<!-- post title -->
		<h2 itemprop="headline">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span itemprop="name"><?php the_title(); ?></span></a>
		</h2>
		<!-- /post title -->

		<!-- post details -->
		<p>
			<span class="date"><span itemprop="dateCreated"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span></span>
			<span class="author"><?php _e( 'Published by', 'bootblank' ); ?> <span itemprop="creator"><?php the_author_posts_link(); ?></span></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'bootblank' ), __( '1 Comment', 'bootblank' ), __( '% Comments', 'bootblank' )); ?></span>
		</p>
		<!-- /post details -->

		<?php //bootblank_excerpt('bootblank_index'); // Build your custom callback length in functions.php ?>
		<p><?php the_excerpt(); ?></p>
		<a href="<?php echo get_permalink(); ?>"> <?php echo __( 'Lire la suite','bootblak'); ?></a>

		<p><?php edit_post_link(); ?></p>

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
