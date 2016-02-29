<?php get_header(); ?>
	<?php 
	global $post;
	?>
	<div class="container content-wrapper">
		<div class="col-lg-9 col-md-9 col-xs-12 col-sm-12">
		<?php 
		//gets single pagination function @ function-custom-made.php
		nnp_single_pagination();
		//custom_breadcrumbs();
		custom_breadcrumbs();
		breadcrumbs();
		if ( have_posts() ): 
			while ( have_posts() ) : the_post(); ?>
				<div class="row row-wrapper">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<h6>Posted On: <?php echo get_the_date('M d, Y', get_the_ID() ); ?> by <?php 
					the_author_posts_link(); ?></h6>
					<h6>Categories: <?php the_category(' '); ?></h6>
					<div class="the-content">
					<?php the_content(); ?>
					</div>
				</div><!--end of row-wrapper-->
			<?php endwhile;
		endif; 
		comments_template(); //get comments.php ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-sidebar">
			<?php dynamic_sidebar('Sidebar'); //get sidebar in widget?>
		</div>
	 </div><!--end of content wrapper -->
<?php get_footer(); ?>