<?php get_header(); ?>
	<div class="container content-wrapper">
		<h4>PAGE.PHP</h4>
		<?php custom_breadcrumbs(); ?>
		<?php breadcrumbs(); ?>
		<?php if ( have_posts() ): 
			while ( have_posts() ): the_post(); ?>
				<div class="row the-post">
					<h1 class="the-title"><?php the_title(); ?></h1>
					<div class="the-content">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile;
		endif; ?>
	</div><!--end of content-wrapper-->
<?php get_footer(); ?>