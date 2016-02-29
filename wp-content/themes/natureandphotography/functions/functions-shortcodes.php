<?php
function register_shortcodes()
{
	add_shortcode( 'clear', 'sc_insertclear' );
}
add_action( 'init', 'register_shortcodes');

function sc_insertclear($atts,$content = null){
	$sdstr = '';
	
	extract(shortcode_atts(array(
       'class' => 'clear'
    ), $atts));

	$sdstr = '<br class="'.$class.'">';
	return $sdstr;
}
?>