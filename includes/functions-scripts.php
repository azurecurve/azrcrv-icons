<?php
/*
	tab output on settings page
*/

/**
 * Declare the Namespace.
 *
 * @since 1.0.0
 */
namespace azurecurve\Icons;

/**
 * Register admin scripts.
 *
 * @since 2.0.0
 */
function register_admin_scripts() {
	wp_register_script( PLUGIN_HYPHEN . '-admin-jquery', esc_url_raw( plugins_url( '../assets/jquery/admin.js', __FILE__ ) ), array(), '1.0.0', true );
	wp_register_script( 'azrcrv-admin-standard-jquery', esc_url_raw( plugins_url( '../assets/jquery/admin-standard.js', __FILE__ ) ), array(), '22.3.2', true );
}

/**
 * Enqueue admin styles.
 *
 * @since 2.0.0
 */
function enqueue_admin_scripts() {
	global $pagenow;

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['page'] ) && ( $_GET['page'] == PLUGIN_HYPHEN || $_GET['page'] == 'azrcrv-plugin-menu' ) ) {
		wp_enqueue_script( PLUGIN_HYPHEN . '-admin-jquery' );
		wp_enqueue_script( 'azrcrv-admin-standard-jquery' );
	}
}
