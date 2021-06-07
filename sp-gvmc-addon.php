<?php
/**
 * Plugin Name: Sputznik GiveWP MailChimp Addon
 * Description: Provides convergence tracking for GiveWp Mailchimp Emails.
 * Version:     1.0
 * Author:      Sputznik
 * Text Domain: spgmc
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! defined( 'SPGMC_DIR' ) ) {
	define( 'SPGMC_DIR', dirname( __FILE__ ) );
}

//Give Plugin activation dependency check
function spgmc_plugin_init() {

	if ( current_user_can( 'activate_plugins' ) && !class_exists('Give') ) {

		add_action( 'admin_notices', 'spgmc_no_give_admin_notice' );
		add_action( 'admin_init', 'spgmc_deactivate' );

	} else {

		add_filter( 'give-settings_get_settings_pages', function($settings) {
			$settings[] = include SPGMC_DIR . '/inc/class-sputznik-give-settings-tab.php';	
			return $settings;
		} );

	}
}

add_action( 'init', 'spgmc_plugin_init' );


//Show notice for Give plugin not active
function spgmc_no_give_admin_notice() {

	$class   = 'notice notice-error';
	$message = sprintf( __( '<strong>Activation Error:</strong> You must have the <a href="%s" target="_blank">Give</a> core plugin installed and activated for the <strong>Sputznik GiveWP MailChimp Add-on</strong> to activate.', 'spgmc' ), 'https://wordpress.org/plugins/give' );
	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );

}


// Deactivate plugin
function spgmc_deactivate() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
}
