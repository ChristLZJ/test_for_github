<?php

if ( ! function_exists( 'ishyoboy_framework_init' ) ) {
	function ishyoboy_framework_init() {

		global $pagenow;

		if ( is_admin() && isset($_GET['activated'] ) && "themes.php" == $pagenow ){
			flush_rewrite_rules();
			// header( 'Location: ' . home_url() . '/wp-admin/themes.php?page=optionsframework' );
		}

	}
}
add_action( 'init', 'ishyoboy_framework_init', 2 );

if ( ! function_exists( 'ishyoboy_options_enqueue_scripts' ) ) {
	function ishyoboy_options_enqueue_scripts() {

		wp_enqueue_script('jquery');

		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
		wp_enqueue_script('media-upload');

		wp_enqueue_style( 'wp-color-picker' );

		wp_register_style( 'ish-fontello', IYB_TEMPLATE_URI . '/assets/frontend/css/ish-fontello.css');
		wp_enqueue_style('ish-fontello');

		wp_register_style( 'ishyoboy_framework_styles', IYB_FRAMEWORK_URI .'/css/framework-styles.css' );
		wp_enqueue_style('ishyoboy_framework_styles');

		wp_register_script( 'ishyoboy-upload', IYB_FRAMEWORK_URI .'/js/upload.js', array('jquery','media-upload','thickbox') );
		wp_enqueue_script('ishyoboy-upload');

		if ( isset($_GET['page']) && isset($_GET['view']) && 'revslider' == $_GET['page'] && 'slide' == $_GET['view']) {
			include( IYB_FRAMEWORK_DIR . '/css/revolution-styles.php' );
		}

		ishyoboy_output_theme_colors_css();

	}
}
add_action('admin_enqueue_scripts', 'ishyoboy_options_enqueue_scripts');

if( is_admin() )
{
	add_action('admin_print_scripts', 'ishyoboy_set_javascritp_paths');
}

/**
 * Hooks
 */
if ( ! function_exists( 'ishyoboy_meta_head' ) ) {
	function ishyoboy_meta_head() {
		do_action('ishyoboy_meta_head');
	}
}