<?php get_header(); ?>
	<div class="container content-wrapper">
		<?php 
		echo '<div class="wrapper" rel="search">';
		echo '<span class="search-label">Search result</span>';
		$querystring = get_search_query();
		$args = array(
			's' => $querystring
			);
		$search = new WP_Query($args);
		?>

		<?php if ( $search->have_posts() ) : ?>
			<!-- pagination here -->
			<!-- the loop -->
			<?php while ( $search->have_posts() ) : $search->the_post(); ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endwhile; ?>
			<!-- end of the loop -->
			<!-- pagination here -->
			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

		<?php
	echo '</div>';
	echo '</div>'; ?>
	</div>
<?php get_footer(); ?>