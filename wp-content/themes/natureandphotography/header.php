<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--accepts post request only-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script async defer data-pin-hover="true" data-pin-color="red" data-pin-tall="true" src="//assets.pinterest.com/js/pinit.js"></script>
	<?php wp_head(); //gets the action wp_head ?>
</head>
<body <?php body_class(); ?>>
	<div id="main-container" class="container-fluid">
		<!--header-->
		<div class="container">
			<img id="header-image" style="width:100%;" src="<?php echo (get_header_image()); ?>" alt="<?php echo (get_bloginfo('title')); ?>"
			id="header-image"/>
		</div>
		<!--menu-->
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
						data-target="#navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo get_home_url(); ?>">
							<?php 
								$logo = null;
								if ($logo) :
									echo $logo;
								else:
									echo bloginfo('title');
								endif;
							?>
						</a>
					</div> <!--end of navbar -header -->
					<?php
						//get_search_form() has navbar-right thats why use custom search;
						//get search form for header - searchheader.php
						get_template_part('searchheader');
			            wp_nav_menu( array(
			                'menu'              => 'primary',
			                'theme_location'    => 'primary',
			                'depth'             => 5,
			                'container'         => 'div',
			                'container_class'   => 'collapse navbar-collapse navbar-right',
			        		'container_id'      => 'navbar-collapse-1',
			                'menu_class'        => 'nav navbar-nav',
			                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			                'walker'            => new wp_bootstrap_navwalker())
			            );
        			?>
				</div><!--end of container fluid-->
			</nav><!--end of nav tag-->
		</div> <!--end of container menu-->
		<!--end of menu-->
