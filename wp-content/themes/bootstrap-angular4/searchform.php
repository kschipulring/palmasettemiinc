<?php
/**
 * Template for displaying search form in bootstrap-angular4 theme
 * 
 * @package bootstrap-angular4
 */
?>
<form role="search" method="get" class="search-form form" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="form-search-input" class="sr-only"><?php _ex('Search for', 'label', 'bootstrap-angular4'); ?></label>
	<div class="input-group">
		<input type="search" id="form-search-input" class="form-control" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'bootstrap-angular4'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'bootstrap-angular4'); ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><?php esc_html_e('Search', 'bootstrap-angular4'); ?></button>
		</span>
	</div>
</form>