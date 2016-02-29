<?php
function CPT_Book() {
	$labels = array(
		'name'               => _x( 'Books', 'post type general name'),
		'singular_name'      => _x( 'Book', 'post type singular name'),
		'menu_name'          => _x( 'Books', 'admin menu'),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'book'),
		'add_new_item'       => __( 'Add New Book'),
		'new_item'           => __( 'New Book'),
		'edit_item'          => __( 'Edit Book'),
		'view_item'          => __( 'View Book'),
		'all_items'          => __( 'All Books'),
		'search_items'       => __( 'Search Books'),
		'parent_item_colon'  => __( 'Parent Books:'),
		'not_found'          => __( 'No books found.'),
		'not_found_in_trash' => __( 'No books found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'			 => 'dashicons-book-alt',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'author' )
	);

	register_post_type( 'book', $args );
}
add_action('init','CPT_Book');

?>