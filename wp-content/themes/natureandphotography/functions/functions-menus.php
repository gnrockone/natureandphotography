<?php 
if (!function_exists('nnp_menu_setup')) {
	function nnp_menu_setup() {
		add_theme_support('menus');
		register_nav_menus(array(
			'primary' => __('Description: Primary Menu'),
			'sidebar' => __('Description: Sidebar Menu'),
			'footer' => __('Description: Footer Menu')
			));
	}
}
add_action('init','nnp_menu_setup');

?>