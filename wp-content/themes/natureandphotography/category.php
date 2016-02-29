<?php get_header(); ?>
	<?php 
	$category = get_category( get_query_var( 'cat' ) );
	$cat_slug = $category->slug;
	$cat_name = $category->cat_name;
	$args = array(
		'category_name' => $cat_slug,
		'post_type' => 'post',
		'post_status' => 'publish'
		);
	$query = new WP_Query( $args ); ?>
	 <div class="container content-wrapper">
	 	<?php breadcrumbs(); ?>
	 	<h1 class="page-title">Category Archives: <i><?php echo $cat_name; ?></i></h1>
		<?php if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="row row-wrapper">
					<?php $post_ID = $post->ID; ?>
					<!-- $post_date = explode($post->post_date); -->
					<h2 class="the-title-h2"><a href="<?php echo get_permalink($post_ID); ?>">
					<?php the_title(); ?></a></h2>
					<h6>Posted On: <?php echo get_the_date('M d, Y',$post_ID); ?> by <?php the_author_posts_link(); ?></h6>
					<div class="the-excerpt"><?php the_excerpt(); ?></div>
				</div>
			<?php endwhile; ?>
			
		<?php endif; 
		wp_reset_query();
		//got at functions-custom-made.php
		nnp_category_pagination();
		?>

	</div><!--end of content wrapper -->
<?php get_footer(); ?>