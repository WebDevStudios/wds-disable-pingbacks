<?php
/**
 * Plugin Name: WDS Disable Pingbacks
 * Plugin URI:  https://github.com/WebDevStudios/wds-disable-pingbacks
 * Description: Disables Pingbacks - all of them.
 * Version:     1.0.0
 * Author:      WebDevStudios
 * Author URI:  https://webdevstudios.com
 * License:     GPLv2
 * Text Domain: wds-disable-pingbacks
 * Domain Path: /languages
 */

add_filter( 'xmlrpc_methods', 'wds_disable_pingbacks' );
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

add_action( 'current_screen', 'wds_disable_pingbacks_options' );
/**
 * Disable the pingbacks checkbox on Settings -> Discussion and display a message.
 *
 * @param WP_Screen $screen The current admin screen we're on.
 * @author Justin Foell
 * @since  1.0.0
 */
function wds_disable_pingbacks_options( $screen ) {
	if ( 'options-discussion' === $screen->id ) {
		wp_register_script( 'wds-disable-pingbacks', plugins_url( 'wds-disable-pingbacks.js', __FILE__ ), 'jquery' );
		$translations = array(
			'disabled_message' => __( '(This has been globally disabled by the WDS Disable Pingbacks plugin.)', 'wds-disable-pingbacks' ),
		);
		wp_localize_script( 'wds-disable-pingbacks', 'wds_disable_pingbacks', $translations );
		wp_enqueue_script( 'wds-disable-pingbacks' );
	}
}
