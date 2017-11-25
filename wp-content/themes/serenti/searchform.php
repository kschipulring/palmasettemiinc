<?php
/**
 * The template for displaying search forms in serenti
 *
 * @package serenti
 */
/*
Template Name: Search Page
*/

get_header();
?>

<section class="content-area">
	<main id="main" class="site-main <?php echo str_replace(' ', '-', strtolower(the_title("", "", false))); ?>" role="main">


		<?php 
		get_template_part( 'content', 'page' );
		?>

		<form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="input-group">
				<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'serenti' ); ?></label>
				<input type="text" class="form-control search-query" placeholder="<?php echo esc_attr_x( 'Search & Help', 'placeholder', 'serenti' ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'serenti' ); ?>" />
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'serenti' ); ?>">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
	</main>
</section>

<?php
get_footer();
