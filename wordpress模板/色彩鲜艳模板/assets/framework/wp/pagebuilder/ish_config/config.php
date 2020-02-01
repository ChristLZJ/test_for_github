<?php
/**
 * Created by PhpStorm.
 * User: VlooMan
 * Date: 6.11.2013
 * Time: 12:33
 */
/*
if (!class_exists('WPBakeryVisualComposerAbstract')) {

	// Activate pagebuilder
	$dir = get_template_directory() . '/assets/framework/wp/pagebuilder/';
	$composer_settings = Array(
		'APP_ROOT'      => $dir . '/js_composer',
		'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
		'APP_DIR'       => 'assets/framework/wp/pagebuilder' . '/js_composer/',
		'CONFIG'        => $dir . '/js_composer/config/',
		'ASSETS_DIR'    => 'assets/',
		'COMPOSER'      => $dir . '/js_composer/composer/',
		'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
		'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
		'USER_DIR_NAME'  => 'assets/framework/wp/pagebuilder/ish_templates', // Path relative to your current theme, where VC should look for new shortcode templates

		//for which content types Visual Composer should be enabled by default
		'default_post_types' => Array( 'page', 'post', 'portfolio-post', 'ishyoboy_slides' )
	);
	require_once locate_template('/assets/framework/wp/pagebuilder/js_composer/js_composer.php');
	$wpVC_setup->init( $composer_settings );
	define( 'IYB_PAGEBUILDER', true);
}*/

if ( function_exists('vc_set_as_theme') ) vc_set_as_theme();

//require_once locate_template('/assets/framework/wp/pagebuilder/js_composer/js_composer.php');


$dir = get_template_directory() . '/wpbakery';

global $composer_settings, $wpVC_setup;
$composer_settings = Array(
	'APP_ROOT'      => $dir . '/js_composer/',
	'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
	'APP_DIR'       => basename( $dir ) . '/js_composer/',
	'CONFIG'        => $dir . '/js_composer/config/',
	'ASSETS_DIR'    => 'assets/',
	'COMPOSER'      => $dir . '/js_composer/composer/',
	'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
	'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
	'USER_DIR_NAME'  => 'assets/framework/wp/pagebuilder/ish_templates', // Path relative to your current theme, where VC should look for new shortcode templates

	//for which content types Visual Composer should be enabled by default
	'default_post_types' => Array( 'page', 'post', 'portfolio-post', 'ishyoboy_slides', 'templatera' )
);

//require_once locate_template('/assets/framework/wp/pagebuilder/js_composer/js_composer.php');
require_once locate_template('/wpbakery/js_composer/js_composer.php');
$wpVC_setup->init( $composer_settings );

vc_disable_frontend();

define( 'IYB_PAGEBUILDER', true);/**/