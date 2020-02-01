<?php
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

if ( ! function_exists( 'dw_resume_setup' ) ) :
function dw_resume_setup() {
	load_theme_textdomain( 'dw-resume', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	$header_args = array(
		'uploads'       => true,
		'width'         => 512,
		'height'        => 960,
		'header-text'   => false,
		'default-image' => get_template_directory_uri() . '/assets/img/header.png',
	);
	add_theme_support( 'custom-header', $header_args );

	register_default_headers( array(
		'default' => array(
			'url' => get_template_directory_uri() . '/assets/img/header.png',
			'thumbnail_url' => get_template_directory_uri() . '/assets/img/header.png',
			'description' => __( 'Default', 'dw-resume' )
		),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

}
endif;
add_action( 'after_setup_theme', 'dw_resume_setup' );

function dw_resume_theme_updater() {
	require( get_template_directory() . '/inc/updater/theme-updater.php' );
	if ( is_admin() && isset( $_GET['activated'] ) ) {
		header( 'Location: '.admin_url().'theme.php?page=dw-resume');
	}
}
add_action( 'after_setup_theme', 'dw_resume_theme_updater' );

function dw_resume_get_repeat_field( $value ) {
  $items = dw_resume_get_theme_option( $value );
  if ( is_string( $items) ) {
      $items = json_decode( $items, true );
  }
  if ( !is_array( $items ) ) {
      $items = array();
  }
  return $items;
}

function dw_resume_get_theme_option( $option_name, $default = '' ) {
	$options = get_theme_mod( 'dw_resume_theme_options' );
	if ( ! empty( $options[$option_name] ) ) {
		return $options[$option_name];
	}
	return $default;
}
