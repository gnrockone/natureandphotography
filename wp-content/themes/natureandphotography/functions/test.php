<?php
	//conditional tags
	//is_archive - returns true if archive page is being displayed
	//is_category - returns true if category page is being displayed
	//is_home - returns true if  blog posts index page is being displayed - set in reading settings
	//is_date - returns true if date page is being displayed
	//is_page - returns true if page is being displayed
	//is_single - returns true if single post is being displayed
	//is_singular - returns true if single page or single post is being displayed
	//is_tag - returns true if tag archive page is being displayed
	//is_tax - returns true if custom taxonomy is being displayed
function breadcrumbs() { ?>
	<?php $breadcrumbs_id = 'breadcrumbs'; ?>
	<?php $breacrumbs_class = 'breadcrumbs'; ?>
	<?php $display = null; ?>
	<?php $front_page_id = get_option( 'page_on_front' ); ?>
	<?php $front_page_title = get_post($front_page_id)->post_title; ?>

	<?php if (is_front_page() ): ?>
		<h4>FRONT PAGE BREADCRUMBS</h4>
	<?php else: //not front page ?>

		<!--for archive pages-->
		<?php if( is_archive() ): ?>
			<ul id="<?php $breadcrumbs_id; ?>" class="<?php $breadcrumbs_class; ?>">
			<?php $display .= '<li id="breadcrumbs-id-'.$front_page_id.'" class="breadcrumbs-home breadcrumbs-item breadcrumbs-item-'.$front_page_id.'">
			<a href="'.get_permalink($front_page_id).'">'. $front_page_title .'</a></li>'; ?>
			<h4>ARCHIVE PAGE</h4>

			<!--for category-->
			<?php if( is_category() ): ?>
				<h4>CATEGORY PAGE</h4>
				<?php $category_object = get_category(get_query_var('cat')); ?>
					<?php if( $category_object->category_parent ): ?>
						<h4>HAS PARENT</h4>
						<?php $category_ids[] = $category_object->term_id; ?>
							<?php while( $category_object->category_parent ): ?>
								<?php $category_object = get_category( $category_object->category_parent ); ?>
								<?php array_push($category_ids,$category_object->term_id);?>
							<?php endwhile; ?>
						<?php $category_ids = array_reverse($category_ids); ?>
						<?php foreach($category_ids as $category_id): ?>
							<?php $display .= '<li id="breadcrumbs-id-' .$category_id. '" class="breadcrumbs-item breadcrumbs-item-' . $category_id . '">
							<a href="' .get_category_link($category_id). '">' .get_category($category_id)->name. '</a></li>'; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<h4>NO PARENT</h4>
						<?php $category_id = $category_object->term_id; ?>
						<?php $display .= '<li id="breadcrumbs-id-'.$category_id.'" class="breadcrumbs-item breadcrumbs-item-'.$category_id.'">
						<a href="'.get_category_link($category_id).'">' .get_category($category_id)->name. '</a></li>'; ?>
					<?php endif; ?>
			<?php endif; ?>
			<!--end for category-->

			<!--for tag-->
			<?php if( is_tag() ): ?>
				<h4>TAG PAGE</h4>
				<?php $tag = get_query_var('tag_id')?>
				<?php $tag_object = get_tag($tag,'book'); ?>
				<?php $tag_id = $tag_object->term_id; ?>
				<?php $tag_name = $tag_object->name; ?>
				<?php $display .= '<li id="breadcrumbs-id-'. $tag_id .'" class="breadcrumbs-item breadcrumbs-item-'. $tag_id .'">
				<a href="'. get_tag_link($tag_id) .'">'. $tag_name .'</a></li>';?>
				<pre><?php print_r($tag_object); ?></pre>
			<?php endif; ?>
			<!--end for tag-->

			<!--for taxonomy-->
			<?php if( is_tax() ): ?>
				<h4>TAX PAGE</h4>
				<?php $tax = get_query_var('taxonomy'); ?>
				<?php $term = get_query_var('term'); ?>
				<?php $term_object = get_term_by('slug', $term, $tax); ?>
				<?php if( $term_object->parent ): ?>
					<h4>TAX HAS PARENT</h4>
					<?php $term_ids[] = $term_object->term_id; ?>
						<?php while( $term_object->parent ): ?>
							<?php $term_object = get_term_by('id', $term_object->parent, $tax ); ?>
							<?php $term_ids[] = $term_object->term_id; ?>
						<?php endwhile; ?>
				<?php $term_ids = array_reverse($term_ids); ?>
				<?php foreach($term_ids as $term_id): ?>
					<?php $display .= '<li id="breadcrumbs-id-' .$term_id. '" class="breadcrumbs-item breadcrumbs-item-'.$term_id.'">
					<a href="'.get_term_link($term_id,$tax).'">'.get_term_by('id',$term_id,$tax)->name.'</a></li>';?>
				<?php endforeach; ?>
				<?php else: ?>
					<?php $term_object = get_term_by('slug',$term,$tax); ?>
					<?php $term_id = $term_object->term_id; ?>
					<?php $display .= '<li id="breadcrumbs-id-'.$term_id.'" class="breadcrumbs-item breadcrumbs-item-'.$term_id.'">
					<a href="'.get_term_link($term_id,$tax).'">'.$term_object->name.'</a></li>';?>
				<?php endif; ?>
			<?php endif; ?>
			<!--end for taxonomy-->

			<!--for date-->
			<?php if( is_date() ): ?>
				<h4>DATE PAGE</h4>
			<?php endif; ?>
			<!--end for date-->

		<!--for singular pages-->	
		<?php elseif ( is_singular() ): ?>
			<h4>SINGULAR PAGE</h4>
			<?php if( is_page() ): ?>
				<h4>PAGE PAGE</h4>
			<?php endif; ?>
			<?php if( is_single() ): ?>
				<h4>SINGLE PAGE</h4>
			<?php endif; ?>
		<?php endif; ?>
	<?php echo $display; ?>
	</ul><!--end of ul -->	
	<?php endif; ?>
<?php } ?>