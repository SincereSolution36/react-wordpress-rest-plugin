<?php
/*
Plugin Name: Dashboard Widget
Plugin URI:
Description: Dashboard widget using react and rest api
Version: 1.0
Author: Andy C
Author URI: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

$chart_data = array (
    '7' => array (
        array (
            "name" => 'Page A',
            "uv"   => 4000,
            "pv"   => 2400,
            "amt"  => 2400,
		),
        array (
            "name" => 'Page B',
            "uv"   => 3000,
            "pv"   => 1398,
            "amt"  => 2210,
		),
        array (
            "name" => 'Page C',
            "uv"   => 2000,
            "pv"   => 9800,
            "amt"  => 2290,
		),
        array (
            "name" => 'Page D',
            "uv"   => 2780,
            "pv"   => 3908,
            "amt"  => 2000,
		),
        array (
            "name" => 'Page E',
            "uv"   => 1890,
            "pv"   => 4800,
            "amt"  => 2181,
		),
        array (
            "name" => 'Page F',
            "uv"   => 2390,
            "pv"   => 3800,
            "amt"  => 2500,
		),
        array (
            "name" => 'Page G',
            "uv"   => 3490,
            "pv"   => 4300,
            "amt"  => 2100,
		),
	),
    '15' => array(
        array (
            "name" => 'Page A',
            "uv"   => 3000,
            "pv"   => 2200,
            "amt"  => 2200,
		),
        array (
            "name" => 'Page B',
            "uv"   => 2800,
            "pv"   => 2398,
            "amt"  => 1210,
		),
        array (
            "name" => 'Page C',
            "uv"   => 1500,
            "pv"   => 9000,
            "amt"  => 2090,
		),
        array (
            "name" => 'Page D',
            "uv"   => 6780,
            "pv"   => 2908,
            "amt"  => 8000,
		),
        array (
            "name" => 'Page E',
            "uv"   => 4890,
            "pv"   => 2800,
            "amt"  => 4181,
		),
        array (
            "name" => 'Page F',
            "uv"   => 2390,
            "pv"   => 4800,
            "amt"  => 6500,
		),
        array (
            "name" => 'Page G',
            "uv"   => 3390,
            "pv"   => 2300,
            "amt"  => 2400,
		),
	),
    '1' => array(
        array (
            "name" => 'Page A',
            "uv"   => 4000,
            "pv"   => 5400,
            "amt"  => 7400,
		),
        array (
            "name" => 'Page B',
            "uv"   => 4000,
            "pv"   => 4398,
            "amt"  => 6210,
		),
        array (
            "name" => 'Page C',
            "uv"   => 6000,
            "pv"   => 45800,
            "amt"  => 7290,
		),
        array (
            "name" => 'Page D',
            "uv"   => 8780,
            "pv"   => 9908,
            "amt"  => 4000,
		),
        array (
            "name" => 'Page E',
            "uv"   => 6890,
            "pv"   => 2800,
            "amt"  => 6181,
		),
        array (
            "name" => 'Page F',
            "uv"   => 8390,
            "pv"   => 2800,
            "amt"  => 8500,
		),
        array (
            "name" => 'Page G',
            "uv"   => 1490,
            "pv"   => 3300,
            "amt"  => 6100,
		),
	)
);


add_action( 'wp_dashboard_setup', 'ac_dashboard_add_widgets' );
function ac_dashboard_add_widgets() {
	wp_add_dashboard_widget( 'ac_dashboard_widget_chart', __( 'Graph Widget', 'ac' ), 'ac_dashboard_widget_chart_handler' );
}

function ac_dashboard_widget_chart_handler() {	
    require_once plugin_dir_path( __FILE__ ) . 'templates/app.php';
}

add_action( 'admin_enqueue_scripts', 'ac_scripts' );
function ac_scripts( $hook ) {
	$screen = get_current_screen();
	if ( 'dashboard' === $screen->id ) {
		wp_enqueue_style( 'ac_style', plugin_dir_url( __FILE__ ) . 'build/index.css', array(), '1.0' );
		wp_enqueue_script( 'ac_script', plugin_dir_url( __FILE__ ) . 'build/index.js', array( 'wp-element' ), '1.0.0', true );
	}
}

/**
 * Rest API Part
 */

add_action( 'rest_api_init', 'add_custom_chart_api');

function add_custom_chart_api(){
    register_rest_route( 'v1/chart/', '(?P<id>\d+)', array(
        'methods'  => 'GET',
        'callback' => 'get_custom_chart_data',
    ));
}

//Customize the callback to your liking
function get_custom_chart_data( $hook ){
	global $chart_data;
    //get chart data
	$id = $hook['id'];
	return json_encode( $chart_data[$id] );
}