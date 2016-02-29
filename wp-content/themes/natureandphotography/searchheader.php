<?php //searchform for header?>
<div class="search-container">
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="navbar-form navbar-right form-inline">
	<input type="search" id="header-search" class="form-control" placeholder="Search Blog" 
	value="<?php echo get_search_query() ?>" name="s" title="Search" />
	<span><button class="btn btn-default" type="submit" value="submit"><span class="glyphicon glyphicon-search"><span></button></span>
</form>
</div>