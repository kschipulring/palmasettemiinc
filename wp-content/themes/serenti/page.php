<?php
/**
 * The template for displaying pages.
 *
 * @package settimi
 */

get_header();

if ( empty($page_class) ) {
	$page_class = "default";
}
?>
fuck you
	<app-root>
		<app-component>Your mom loves sodomy</app-component>
	</app-root>
	
murdarmachene

	<section class="content-area">
		<main id="main" class="site-main <?php echo $page_class; ?>" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main>
	</section>

<?php
//get_sidebar();

get_footer();
