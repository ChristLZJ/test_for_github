<?php

global $vc_manager;
$ish_supported_vc_version = '4.3.4';

// Load the admin notices functionality functions
require_once( locate_template( 'assets/framework/wp/pagebuilder/ish_config/admin_notices.php' ) );

/**
 * Activate VC from Theme callback
 */
if ( ! function_exists( 'ishyoboy_activate_vc_from_theme' ) ){
	function ishyoboy_activate_vc_from_theme() {
		define( 'IYB_PAGEBUILDER', true);
		require_once( locate_template( 'wpbakery/js_composer/js_composer.php' ) );
	}
}

/**
 * Load VC from Theme or Plugin
 */
if ( ! isset( $vc_manager ) || ! is_object( $vc_manager ) ){
	// VC - Theme

	if ( ! ( ( isset( $_GET['action'] ) && 'activate' == $_GET['action'] ) && ( isset( $_GET['plugin'] ) && 'js_composer/js_composer.php' == $_GET['plugin'] ) ) ){
		// Do not load if activating visual composer plugin - otherwise it will generate activation error
		add_action( 'after_setup_theme', 'ishyoboy_activate_vc_from_theme' );
	}

} else {
	// VC - Plugin

	// Add notices
	if ( ( version_compare( WPB_VC_VERSION, $ish_supported_vc_version) === -1 ) ) {
		add_action( 'admin_notices', 'ishyoboy_old_vc_version_notice' );
	}
	else if ( ( version_compare( WPB_VC_VERSION, $ish_supported_vc_version) === 1 ) ) {
		add_action( 'admin_notices', 'ishyoboy_new_vc_version_notice' );
	}
}

/**
 * Update Visual Composer settings once loaded.
 */
if ( ! function_exists( 'ishyoboy_vc_set_shortcodes_templates_dir' ) ){
	function ishyoboy_vc_set_shortcodes_templates_dir() {

		// Set Default Post Types
		vc_set_default_editor_post_types( array(
			'page',
			'post',
			'portfolio-post',
			'ishyoboy_slides',
			'templatera' )
		);

		// Force Visual Composer to initialize as "built into the theme".
		vc_set_as_theme( true ); // add "true" to disable the automatic updater

		//Disable Frontend Editor
		vc_disable_frontend();


		// Remove the default Layout Templates List
		if ( ! function_exists( 'ishyoboy_vc_load_default_templates' ) ){
			function ishyoboy_vc_load_default_templates( $data ) {
				return array(); // This will remove all default templates
			}
		}
		add_filter( 'vc_load_default_templates', 'ishyoboy_vc_load_default_templates' );

	}
}
add_action( 'vc_before_init', 'ishyoboy_vc_set_shortcodes_templates_dir' );