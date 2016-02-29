<?php 
/*
	==================================================
	| Category Pagination
	==================================================
 */
function nnp_category_pagination() {
	foreach(get_categories() as $all_cat) {  $cat_ids[] = $all_cat->term_id; }
  	$this_cat = get_query_var('cat');
  	$this_cat_position = array_search( $this_cat, $cat_ids ); ?>

	<div class="pagination-category row-pagination row">
	<?php $prev_cat_position = $this_cat_position -1;
    if( $prev_cat_position >=0 ) {
    $prev_cat_id = array_slice( $cat_ids, $prev_cat_position, 1 );
    echo '<a class="pull-left" href="' . get_category_link($prev_cat_id[0]) . '">&laquo; ' . get_category($prev_cat_id[0])->name . '</a>'; } ?>

	<?php $next_cat_position = $this_cat_position +1;
    if( $next_cat_position < count($cat_ids) ) {
    $next_cat_id = array_slice( $cat_ids, $next_cat_position, 1 );
	echo '<a class="pull-right" href="' . get_category_link($next_cat_id[0]) . '">' . get_category($next_cat_id[0])->name . ' &raquo;</a>'; } ?>
	</div><!--end of pagination-category-->
<?php } 
	/*
	==================================================
	| Single Post Pagination for Post Type
	| Change post_type for custom post type
	==================================================
 	*/
 function nnp_single_pagination() {
 	$this_post_ID = get_queried_object_id();
 	$query = array(
 		'orderby' => 'menu_order',
 		'sort_order' => 'asc',
 		'post_type' => 'post',
 		'post_status' => 'publish',
 		'posts_per_page' => -1
 		);
 	$postlist = get_posts( $query );
	$posts = array();
	foreach ( $postlist as $post ) {
   	$posts[] += $post->ID;
	}
	$this_post_position = array_search($this_post_ID,$posts);
	$next_post_position = $this_post_position + 1;
	$prev_post_position = $this_post_position - 1;
	echo '<div class="row-pagination row pagination-post">';
	if ($prev_post_position >= 0) {
		$prev_post_ID = array_slice($posts, $prev_post_position ,1);
		echo '<a class="pull-left" href="' . get_post_permalink($prev_post_ID[0]) . '">&laquo; ' . get_post($prev_post_ID[0])->post_title . '</a>';
	}
	if ($next_post_position < count($posts) ) {
		$next_post_ID = array_slice($posts, $next_post_position ,1);
		echo '<a class="pull-right" href="' . get_post_permalink($next_post_ID[0]) . '">' . get_post($next_post_ID[0])->post_title . ' &raquo;</a>';
	}
	echo '</div>';
 }
 	







?>