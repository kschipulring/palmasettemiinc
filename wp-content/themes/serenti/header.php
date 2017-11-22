<?php
/**
 *
 * @package serenti
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
		<script src="https://use.fontawesome.com/22c47afbf3.js"></script>
	</head>
	<body <?php body_class(); ?>>

		<!-- Navigation -->
		<nav class="navbar" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display --> 
				<div class="navbar-header"> 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
						<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'serenti' ); ?></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span>
					</button> 
				</div>
				<!--<nav class="navbar top right" role="navigation">-->
					<?php //wp_nav_menu( array( 'theme_location' => "top-menu", 'menu_class' => "menu container" ) ); ?>
				<!--</nav>-->

				
				<?php serenti_header_menu( array( 'menu_class' => "menu container" ) ); // main navigation ?>
			</div>
		</nav>
		<!-- End: Navigation -->

		<!--
		<div class="container">
			<header class="header" id="header">
				<div class="container">
					<?php serenti_the_custom_logo(); ?>
				</div>
			</header>
		</div>
		-->

			<?php
				global $post;
				if( is_singular() && get_post_meta($post->ID, 'site_layout', true) ){
					$layout_class = get_post_meta($post->ID, 'site_layout', true);
				}
				else{
					$layout_class = get_theme_mod( 'serenti_sidebar_position' );
				}
				if ((isset($layout_class)) && ($layout_class == '')) $layout_class = "mz-sidebar-right";
			?>

			<!-- BEGIN .container -->
			<div class="container <?php echo esc_attr($layout_class); ?>">

			<div id="content">
				<div class="row">
					<div class="<?php echo esc_attr(serenti_content_bootstrap_classes()); ?>">
