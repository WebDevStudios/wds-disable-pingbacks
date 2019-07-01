<?php
/**
 * Plugin Name: WDS Disable Pingbacks
 * Plugin URI:  https://github.com/WebDevStudios/wds-disable-pingbacks
 * Description: Disables Pingbacks - all of them.
 * Version:     1.1.0
 * Author:      WebDevStudios
 * Author URI:  https://webdevstudios.com
 * License:     GPLv2
 * Text Domain: wds-disable-pingbacks
 * Domain Path: /languages
 *
 * @package     WebDevStudios\wds-disable-pingbacks
 * @since       1.0.0
 */

add_filter( 'xmlrpc_methods', 'wds_disable_pingbacks' );
add_action( 'current_screen', 'wds_disable_pingbacks_options' );
add_filter( 'wp_headers', 'wds_disable_pingbacks_modify_wp_headers', 110, 1 );
add_filter( 'bloginfo_url', 'wds_disable_pingbacks_pingback_url', 11, 2 );

/**
 * Disable pingbacks in xmlrpc.php by removing it from the available methods list.
 *
 * @param array $methods Array of xmlrpc methods.
 * @return array Enabled xmlrpc methods.
 * @author Justin Foell
 * @since  1.0.0
 */
function wds_disable_pingbacks( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}

/**
 * Disable the pingbacks checkbox on Settings -> Discussion and display a message.
 *
 * @param WP_Screen $screen The current admin screen we're on.
 * @author Justin Foell
 * @since  1.0.0
 *
 * @return void
 */
function wds_disable_pingbacks_options( $screen ) {
	if ( 'options-discussion' !== $screen->id ) {
		return;
	}

	wp_register_script( 'wds-disable-pingbacks', plugins_url( 'wds-disable-pingbacks.js', __FILE__ ), 'jquery' ); // @codingStandardsIgnoreLine: Leave in header.

	wp_localize_script( 'wds-disable-pingbacks', 'wds_disable_pingbacks', [
		'disabled_message' => __( '(This has been globally disabled by the WDS Disable Pingbacks plugin.)', 'wds-disable-pingbacks' ),
	] );

	wp_enqueue_script( 'wds-disable-pingbacks' );
}

/**
 * Ensure DOC headers are not recognized.
 *
 * @author Aubrey Portwood <aubrey@webdevstudios.com>
 * @since  1.1.0
 *
 * @param array $headers The headers.
 *
 * @return array Modified headers.
 */
function wds_disable_pingbacks_modify_wp_headers( $headers ) {
	if ( isset( $headers['X-Pingback'] ) ) {
		unset( $headers['X-Pingback'] );
	}

	return $headers;
}

/**
 * Hijack pingback_url for get_bloginfo (<link rel="pingback" />).
 *
 * @author Aubrey Portwood <aubrey@webdevstudios.com>
 * @since  1.1.0
 *
 * @param mixed  $output   The output of the URL (usually a string).
 * @param string $property The property.
 *
 * @return mixed The output, null when disabled.
 */
function wds_disable_pingbacks_pingback_url( $output, $property ) {
	return ( 'pingback_url' === $property ) ? null : $output;
}
