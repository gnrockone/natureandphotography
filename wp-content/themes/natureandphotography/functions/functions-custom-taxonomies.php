<?php 
add_action('init','create_camera_taxonomies');
add_action('init','create_location_taxonomies');
add_action('init','create_bookcover_taxonomies');

//create camera taxonomies in post type
//heirarchical
function create_camera_taxonomies() {
	$labels = array(
		'name'              => __( 'Cameras'),
		'singular_name'     => __( 'Camera'),
		'search_items'      => __( 'Search Cameras' ),
		'all_items'         => __( 'All Cameras' ),
		'parent_item'       => __( 'Parent Camera' ),
		'parent_item_colon' => __( 'Parent Camera:' ),
		'edit_item'         => __( 'Edit Camera' ),
		'update_item'       => __( 'Update Camera' ),
		'add_new_item'      => __( 'Add New Camera' ),
		'new_item_name'     => __( 'New Genre Camera' ),
		'menu_name'         => __( 'Camera' ),
	);

	$capabilities = array(
		'manage_terms' => 'manage_categories',
		'edit_terms'   => 'manage_categories',
		'delete_terms' => 'manage_categories',
		'assign_terms' => 'edit_posts' 
		);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'capabilities'		=> $capabilities,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('heirarchical' => true )
	);
	register_taxonomy('Camera','post',$args);
}

//create location taxonomies in post type
//not heirarchical
function create_location_taxonomies() {
	$labels = array(
		'name'                       => __( 'Locations'),
		'singular_name'              => __( 'Location'),
		'search_items'               => __( 'Search Locations' ),
		'popular_items'              => __( 'Popular Locations' ),
		'all_items'                  => __( 'All Locations' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Location' ),
		'update_item'                => __( 'Update Location' ),
		'add_new_item'               => __( 'Add New Location' ),
		'new_item_name'              => __( 'New Location Name' ),
		'separate_items_with_commas' => __( 'Separate Locations with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Locations' ),
		'choose_from_most_used'      => __( 'Choose from the most used Locations' ),
		'not_found'                  => __( 'No Locations found.' ),
		'menu_name'                  => __( 'Locations' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array('heirarchical' => true)
	);
	register_taxonomy('location','post',$args);
}

//create book cover for custom post type books
function create_bookcover_taxonomies() {
	$labels = array(
		'name'              => __( 'Book Covers'),
		'singular_name'     => __( 'Book Cover'),
		'search_items'      => __( 'Search Book Covers' ),
		'all_items'         => __( 'All Book Covers' ),
		'parent_item'       => __( 'Parent Book Cover' ),
		'parent_item_colon' => __( 'Parent Book Cover:' ),
		'edit_item'         => __( 'Edit Book Cover' ),
		'update_item'       => __( 'Update Book Cover' ),
		'add_new_item'      => __( 'Add New Book Cover' ),
		'new_item_name'     => __( 'New Genre Book Cover' ),
		'menu_name'         => __( 'Book Cover' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('heirarchical' => true)
	);
	register_taxonomy('bookcover','book',$args);
}

?>