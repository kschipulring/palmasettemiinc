<?php 
/*
Plugin Name: WP-REST-API V2 Menus
Version: 0.2
Description: Adding menus endpoints on WP REST API v2
Author: Claudio La Barbera
Author URI: http://www.claudiolabarbera.com
*/

/*class WP_REST_Request_params extends WP_REST_Request {
	public static $params = parent;
}*/

/**
 * Get all registered menus
 * @return array List of menus with slug and description
 */
function wp_api_v2_menus_get_all_menus () {
    $menus = [];
    foreach (get_registered_nav_menus() as $slug => $description) {
        $obj = new stdClass;
        $obj->slug = $slug;
        $obj->description = $description;
        $menus[] = $obj;
    }

    return $menus;
}

/**
 * Get menu's data from his id
 * @param  array $data WP REST API data variable
 * @return object Menu's data with his items
 */
function wp_api_v2_menus_get_menu_data ( $data ) {
	var_dump( $data );

    $menu = new stdClass;
    $menu = wp_get_nav_menu_object( $data['id'] );
    $menu->items = wp_get_nav_menu_items($menu->term_id);
    return $menu;
}

function wp_api_v2_menus_get_menu_data_from_primary($data){
	global $wpdb;


	$querystr = <<<QRY
SELECT ce2.option_value AS i
FROM $wpdb->options ce
LEFT JOIN $wpdb->options ce2
ON ce2.option_name = CONCAT("theme_mods_",  ce.option_value)
WHERE ce.option_name = "template"
 LIMIT 0,1
QRY;

	$the_num = $wpdb->get_results($querystr, OBJECT);

	$num_obj = unserialize( $the_num[0]->i );

	$menu_id = $num_obj["nav_menu_locations"]["primary"];

	return wp_api_v2_menus_get_menu_data_from_numid($menu_id);
}

function wp_api_v2_menus_get_menu_data_from_url_numid($data){
	$data_arr = (array)$data;
	$data_params = array();

	foreach($data_arr as $key=>$val){
		if( strstr($key, "params") ){
			$data_params = $val;

			break;
		}
	}

	$menu_id = $data_params["URL"][1];

	return wp_api_v2_menus_get_menu_data_from_numid($menu_id);
}

function wp_api_v2_menus_get_menu_data_from_numid($menu_id){
	global $wpdb;

 	$querystr = <<<QRY
	SELECT cp.menu_order AS o, cpm.meta_value AS i, cp2.post_name AS u, cp2.post_title AS t 
	FROM $wpdb->term_relationships AS tr
	INNER JOIN $wpdb->term_taxonomy AS tt
	ON tr.term_taxonomy_id = tt.term_taxonomy_id
	LEFT JOIN $wpdb->posts cp
	ON cp.ID = tr.object_id
	LEFT JOIN $wpdb->postmeta cpm
	ON cpm.post_id = cp.ID
	LEFT JOIN $wpdb->posts cp2
	ON cp2.ID = cpm.meta_value
	WHERE tt.taxonomy IN ('nav_menu')
	AND tt.term_id IN ($menu_id)
	AND cpm.meta_key = "_menu_item_object_id"
	ORDER BY tr.object_id ASC
QRY;

 	$menu = $wpdb->get_results($querystr, OBJECT);

 	return $menu;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'menus/v1', '/menus', array(
        'methods' => 'GET',
        'callback' => 'wp_api_v2_menus_get_all_menus',
    ) );

    register_rest_route( 'menus/v1', '/menus/([0-9]+)', array(
        'methods' => 'GET',
        'callback' => 'wp_api_v2_menus_get_menu_data_from_url_numid',
    ) );

    register_rest_route( 'menus/v1', '/menus/(primary)+', array(
        'methods' => 'GET',
        'callback' => 'wp_api_v2_menus_get_menu_data_from_primary',
    ) );

    register_rest_route( 'menus/v1', '/menus/(?P<id>[a-zA-Z(-]+)', array(
        'methods' => 'GET',
        'callback' => 'wp_api_v2_menus_get_menu_data',
    ) );
} );
