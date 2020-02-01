<?php
function dw_resume_admin_menu() {
	add_theme_page(
		__( 'DW Resume', 'dw-resume' ),
		__( 'DW Resume', 'dw-resume' ),
		'manage_options',
		'dw-resume',
		'dw_resume_intro'
	);
}
add_action( 'admin_menu', 'dw_resume_admin_menu' );

function dw_resume_intro() {
	$current_theme = wp_get_theme(); ?>
	<div class="wrap about-wrap">
		<h1><?php printf( __( 'Welcome to %1s %2s', 'dw-resume' ), $current_theme->get( 'Name' ), $current_theme->get( 'Version' ) ); ?></h1>
		<p class="about-text"><?php _e( 'Thank you for purchasing our WordPress theme. If you have any question about this theme, please submit to our <a href="https://www.designwall.com/question/">Q&A section</a>.', 'dw-resume' ); ?></p>
		<h2 class="nav-tab-wrapper" id="dw-tabs"><a class="nav-tab nav-tab-active" href="#top#getting-started" id="getting-started-tab"><?php _e( 'Getting Started', 'dw-resume' ); ?></a></h2>
		<div id="getting-started" class="active">
			<p class="about-description"><?php printf( __( 'Use the tips below to get started using %s. You will be up and running in no time!', 'dw-resume' ), $current_theme->get( 'Name' ) ); ?></p>
			<br>
			<h2><?php _e( '1. Theme Customizer', 'dw-resume' ); ?></h2>
			<p><?php _e( 'DW Ressume supports the Theme Customizer for all theme settings. Click "Customize" to start customize your site.', 'dw-resume' ); ?></p>
			<p><a href="customize.php" target="_blank" class="button button-primary"><?php _e( 'Customize &rarr;', 'dw-resume' ); ?></a></p>
			<br>
			<h2><?php _e( '2. Input Your Theme License', 'dw-resume' ); ?></h2>
			<p><?php _e( 'The theme license key is just aimed at making the update easier with the one-click-update feature. Once you enter the theme license key, your website is constantly updating the patch without logging in to DesignWall website. If you haven’t had the theme license yet, <a href="https://www.designwall.com/my-account/" target="_blank">click here</a>.', 'dw-resume' ); ?></p>
			<p><a href="theme.php?page=dw-resume-license" target="_blank" class="button button-primary"><?php _e( 'Click here to input your license &rarr;', 'dw-resume' ); ?></a></p>
		</div>
		<div
	</div>
	<?php
}
