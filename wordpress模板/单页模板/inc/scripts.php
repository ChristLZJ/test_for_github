<?php
function dw_resume_scripts() {
	global $wp_version;
	$version = wp_get_theme( wp_get_theme()->template )->get( 'Version' );

	if ( defined( 'WP_ENV' ) && 'development' === WP_ENV ) {
		$assets = array(
			'css' => '/assets/css/dw-resume.css',
			'js'  => '/assets/js/dw-resume.js',
		);
	} else {
		$assets = array(
			'css' => '/assets/css/dw-resume.min.css',
			'js'  => '/assets/js/dw-resume.min.js',
		);
	}
	wp_enqueue_style( 'pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css' );
	// wp_enqueue_style( 'pe-icon-7-stroke-helper', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke-helper.css' );
	wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css' );
	wp_enqueue_style( 'dw-resume-main', get_template_directory_uri() . $assets['css'], array(), $version );
	wp_enqueue_style( 'dw-resume-style', get_stylesheet_uri() );
	wp_enqueue_style( 'dw-focus-print', get_template_directory_uri() . '/assets/css/print.css', array(), $version, 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array(), $version, false );
	wp_enqueue_script( 'dw-resume-script', get_template_directory_uri() . $assets['js'], array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'dw_resume_scripts' );

function dw_resume_css_output() {
	$custom_css = '';
  $custom_css .='<style type="text/css" id="dw-resume-custom-css">';
  $custom_css .= ( dw_resume_get_theme_option( 'primary_color' ) != '' )  ? '.site-header .header-image a, .section.section-skills .section-header, .progress-bar-info, .section.section-cta, .site-header .navbar-brand span, .back-to-top, ::selection { background-color:'. dw_resume_get_theme_option( 'primary_color' ).';} .section.section-portfolio .project > a:hover { box-shadow: 0 0 0 8px '. dw_resume_get_theme_option( 'primary_color' ).';}' : '';
  $custom_css .= ( dw_resume_get_theme_option( 'text_color' ) != '' )  ? 'body{ color:'. dw_resume_get_theme_option( 'text_color' ).';}' : '';
	$custom_css .= ( dw_resume_get_theme_option( 'link_color' ) != '' )  ? 'a { color:'. dw_resume_get_theme_option( 'link_color' ).';}' : '';
	$custom_css .= ( dw_resume_get_theme_option( 'link_hover_color' ) != '' )  ? 'a:hover { color:'. dw_resume_get_theme_option( 'link_hover_color' ).';}' : '';
	$custom_css .= ( dw_resume_get_theme_option( 'heading_font' ) != '' )  ? 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: "'.dw_resume_get_theme_option( 'heading_font' ).'", "Helvetica Neue", Helvetica, Arial, sans-serif; }' : '';
	$custom_css .= ( dw_resume_get_theme_option( 'content_font' ) != '' )  ? 'body { font-family: "'.dw_resume_get_theme_option( 'content_font' ).'", "Helvetica Neue", Helvetica, Arial, sans-serif; }' : '';
  $custom_css .='</style>';
  echo $custom_css;
}
add_action( 'wp_head', 'dw_resume_css_output');

function dw_resume_google_fonts() {
	$heading_font = dw_resume_get_theme_option( 'heading_font', 'Raleway' );
	$content_font = dw_resume_get_theme_option( 'content_font', 'Karla' );
	$google_fonts = dw_resume_get_google_fonts( );
	// print_r( $google_fonts );
	foreach ( $google_fonts as $key => $value) {
		if ( $key == $heading_font ) {
			$heading_font = str_replace( ' ', '+', $heading_font ).':'.implode( ',', $value['variants'] );
		}

		if ( $key == $content_font ) {
			$content_font = str_replace( ' ', '+', $content_font ).':'.implode( ',', $value['variants'] );
		}
	}
	$query_args = array(
		'family' => $heading_font.'|'.$content_font
	);
	wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'google_fonts');
}

add_action('wp_print_styles', 'dw_resume_google_fonts');

