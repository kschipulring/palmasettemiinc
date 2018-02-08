<?php
/**
 * settimi theme Customizer
 *
 * @package settimi
 */

function settimi_theme_options( $wp_customize ) {
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register' , 'settimi_theme_options' );

/**
 * Options for WordPress Theme Customizer.
 */
function settimi_customizer( $wp_customize ) {

	global $settimi_site_layout, $settimi_thumbs_layout;

	/**
	 * Section: Color Settings
	 */

	// Change accent color
	$wp_customize->add_setting( 'settimi_accent_color', array(
		'default'        => '#d0c5c1',
		'sanitize_callback' => 'settimi_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'settimi_accent_color', array(
		'label'     => __('Accent color','settimi'),
		'section'   => 'colors',
		'priority'  => 1,
	)));

	// Change Links color
	$wp_customize->add_setting( 'settimi_links_color', array(
		'default'        => '#141415',
		'sanitize_callback' => 'settimi_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'settimi_links_color', array(
		'label'     => __('Links color','settimi'),
		'section'   => 'colors',
		'priority'  => 2,
	)));

	// Change hover color
	$wp_customize->add_setting( 'settimi_hover_color', array(
		'default'        => '#23527c',
		'sanitize_callback' => 'settimi_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'settimi_hover_color', array(
		'label'     => __('Links hover color','settimi'),
		'section'   => 'colors',
		'priority'  => 3,
	)));

	// Change buttons hover color
	$wp_customize->add_setting( 'settimi_buttons_hover_color', array(
		'default'        => '#d0c5c1',
		'sanitize_callback' => 'settimi_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'settimi_buttons_hover_color', array(
		'label'     => __('Links hover color','settimi'),
		'section'   => 'colors',
		'priority'  => 4,
	)));

	/**
	 * Section: Post Settings
	 */

	$wp_customize->add_section('settimi_post_section', 
		array(
			'priority' => 31,
			'title' => __('Post Settings', 'settimi'),
			'description' => __('change post settings', 'settimi'),
			)
		);

		// Post Thumbnail Layout
		$wp_customize->add_setting('settimi_thumbs_layout', array(
			'default' => 'landscape',
			'sanitize_callback' => 'settimi_sanitize_thumbs'
		));

		$wp_customize->add_control('settimi_thumbs_layout', array(
			'priority'  => 2,
			'label' => __('Thumbnail Layout', 'settimi'),
			'section' => 'settimi_post_section',
			'type'    => 'select',
			'description' => __('Choose post thumbnail layout', 'settimi'),
			'choices'    => $settimi_thumbs_layout
		));

	/**
	 * Section: Theme layout options
	 */

	$wp_customize->add_section('settimi_layout_section', 
		array(
			'priority' => 32,
			'title' => __('Layout options', 'settimi'),
			'description' => __('Choose website layout', 'settimi'),
			)
		);

		// Sidebar position
		$wp_customize->add_setting('settimi_sidebar_position', array(
			'default' => 'mz-sidebar-right',
			'sanitize_callback' => 'settimi_sanitize_layout'
		));

		$wp_customize->add_control('settimi_sidebar_position', array(
			'priority'  => 1,
			'label' => __('Website Layout Options', 'settimi'),
			'section' => 'settimi_layout_section',
			'type'    => 'select',
			'description' => __('Choose between different layout options to be used as default', 'settimi'),
			'choices'    => $settimi_site_layout
		));

		// checkbox center menu
		$wp_customize->add_setting( 'settimi_menu_center', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'settimi_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'settimi_menu_center', array(
			'priority'  => 2,
			'label'     => __('Center Menu?','settimi'),
			'section'   => 'settimi_layout_section',
			'type'      => 'checkbox',
		) );

	/**
	 * Section: Change footer text
	 */

	// Change footer copyright text
	$wp_customize->add_setting( 'settimi_footer_text', array(
		'default'        => '',
		'sanitize_callback' => 'settimi_sanitize_input',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( 'settimi_footer_text', array(
		'label'     => __('Footer Copyright Text','settimi'),
		'section'   => 'title_tagline',
		'priority'    => 31,
	));

}

add_action( 'customize_register', 'settimi_customizer' );

/**
 * Adds sanitization for text inputs
 */
function settimi_sanitize_input($input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Adds sanitization callback function: Slider Category
 */
function settimi_sanitize_slidercat( $input ) {
	if ( array_key_exists( $input, settimi_cats()) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze checkbox for WordPress customizer
 */
function settimi_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitze number for WordPress customizer
 */
function settimi_sanitize_number($input) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Sanitze blog layout
 */
function settimi_sanitize_layout( $input ) {
	global $settimi_site_layout;
	if ( array_key_exists( $input, $settimi_site_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze thumbs layout
 */
function settimi_sanitize_thumbs( $input ) {
	global $settimi_thumbs_layout;
	if ( array_key_exists( $input, $settimi_thumbs_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze colors
 */
function settimi_sanitize_hexcolor($color)
{
	if ($unhashed = sanitize_hex_color_no_hash($color)) {
		return '#'.$unhashed;
	}

	return $color;
}