<?php
/**
 * Plugin Name: WP Disable Pingbacks
 * Plugin URI:  https://github.com/jrfoell/wp-disable-pingbacks
 * Description: Disables Pingbacks - all of them.
 * Version:     1.0.0
 * Author:      WebDevStudios
 * Author URI:  https://webdevstudios.com
 * License:     GPLv2
 * Text Domain: wp-disable-pingbacks
 * Domain Path: /languages
 */

add_filter( 'xmlrpc_methods', 'wp_disable_pingbacks' );

function wp_disable_pingbacks( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}