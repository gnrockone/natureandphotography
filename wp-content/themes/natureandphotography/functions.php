<?php 

require get_template_directory() . '/functions/functions-scripts.php'; //script functions
require get_template_directory() . '/functions/functions-menus.php'; //menu functions
require get_template_directory() . '/functions/functions-menus-bootstrap-walker.php';
require get_template_directory() . '/functions/functions-widgets.php';
require get_template_directory() . '/functions/functions-custom-posts.php';
require get_template_directory() . '/functions/functions-custom-taxonomies.php';
require get_template_directory() . '/functions/functions-custom-made.php'; //custom made functions
require get_template_directory() . '/functions/functions-shortcodes.php';
require get_template_directory() . '/functions/functions-images.php';
require get_template_directory() . '/functions/functions-breadcrumbs.php';
require get_template_directory() . '/functions/functions-comments.php';
require get_template_directory() . '/functions/test.php';
/*
	==================================================
	| Add theme support
	==================================================
 */

//feature: 'custom-background' - adds background in the appearance menu in the dashboard
add_theme_support('custom-background');
//example. add_theme_support('post-formats',('aside','gallery','link'));
add_theme_support('post-formats',array('aside','image','video'));
//example. add_theme_support('html5',array('comment-list','comment-form','search-form'));
add_theme_support('html5',array('search-form','comment-form','gallery','comment-list'));
//enable theme_support for title-tag, Let WordPress manage the document title.
// By adding theme support, we declare that this theme does not use a
// hard-coded <title> tag in the document head, and expect WordPress to
// provide it for us.
add_theme_support('title-tag');


//adds theme support for custom header
$defaults = array(
	'default-image'          => '',
	'width'                  => 1140,
	'height'                 => 250,
	'flex-height'            => false,
	'flex-width'             => true,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

/*
	==================================================
	| Filtering the_excerpt
	==================================================
 */

function new_excerpt_more() {
    global $post;
	return '<a class="continue-reading" href="'. get_permalink($post->ID) . '">...Continue Reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

if ( ! function_exists( 'twentyfifteen_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfifteen' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'twentyfifteen' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'twentyfifteen' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;













?>