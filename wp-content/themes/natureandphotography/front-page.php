<?php get_header(); ?>
	<?php
	$post_types = get_post_types(array(
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true
		));
	$args = array(
		'post_type'     => $post_types,
		'posts_per_page' => 10,
		'order'         => 'DESC'
		); 
	$query = new WP_Query($args) ?>
	<div class="container content-wrapper ms-container">
		<?php breadcrumbs(); ?>
		<div class="row row-wrapper ms-row">
		<?php 
			if ( $query->have_posts() ):
				while ( $query->have_posts() ) : $query->the_post(); 
				$post_ID = $post->ID;
				$post_title = $post->post_title;
				$post_content = $post->post_content;
				?>
					<div class="ms-item col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<h2 class="the-title-h2 the-title"><a href="<?php echo get_permalink(); ?>">
						<?php the_title(); ?></a></h2>
						<a href="<?php echo get_permalink(); ?>">
						<div class="the-thumbnail"><?php the_post_thumbnail('500x500')?></div></a>
						<div class="the-excerpt"><?php the_excerpt(); ?></div>
					</div>
				<?php endwhile;
			endif;
			wp_reset_query();
		?>
		</div><!--end of row-wrapper-->
		<div class="row">
			<?php if( have_posts() ): ?>
				<?php while( have_posts() ): the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div><!--end of content wrapper-->
	<form method="POST">
		<input id="load-more" type="submit" value="load more">
	</form>
<?php get_footer(); ?>