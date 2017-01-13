<?php
/**
 * Plugin Name:     Bugspress
 * Plugin URI:      http://www.calibreworks.com
 * Description:     This plugin is for bugs reporting system
 * Author:          Ivan Kristianto & Viankakrisna
 * Author URI:      http://www.ivankristianto.com
 * Text Domain:     bugspress
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Bugspress
 */

define('BP_FILE', __FILE__ , true);
define('BP_PATH', plugin_dir_path( __FILE__ ), true);
define('BP_URL', plugin_dir_url( __FILE__ ), true);

// Add Post Types.
require_once( 'post-types/ticket.php' );

function register_api_endpoint(){

}
add_action( 'rest_api_init', 'register_api_endpoint' );

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'wp-api' );
} );
