<?php
// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.designwall.com',
		'item_name' => 'DW Resume',
		'theme_slug' => 'dw-resume',
		'version' => '1.0.0',
		'author' => 'DesignWall',
		'download_id' => '',
		'renew_url' => ''
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'License Manager', 'dw-resume' ),
		'enter-key' => __( 'Enter your theme license key.', 'dw-resume' ),
		'license-key' => __( 'License Key', 'dw-resume' ),
		'license-action' => __( 'License Action', 'dw-resume' ),
		'deactivate-license' => __( 'Deactivate License', 'dw-resume' ),
		'activate-license' => __( 'Activate License', 'dw-resume' ),
		'license-unknown' => __( 'License status is unknown.', 'dw-resume' ),
		'renew' => __( 'Renew?', 'dw-resume' ),
		'unlimited' => __( 'unlimited', 'dw-resume' ),
		'license-key-is-active' => __( 'License key is active.', 'dw-resume' ),
		'expires%s' => __( 'Expires %s.', 'dw-resume' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'dw-resume' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'dw-resume' ),
		'license-key-expired' => __( 'License key has expired.', 'dw-resume' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'dw-resume' ),
		'wn-license-keys-do-not-match' => __( 'License keys do not match. %3$sCheck your license key here%4$s', 'dw-resume' ),
		'wn-license-is-inactive' => __( 'License is inactive. %3$sCheck your license key here%4$s', 'dw-resume' ),
		'wn-license-key-is-disabled' => __( 'License key is disabled. %3$sCheck your license key here%4$s', 'dw-resume' ),
		'site-is-inactive' => __( 'License is inactive', 'dw-resume' ),
		'wn-site-is-inactive' => __( 'License is inactive. Please %1$sactivate your license%2$s', 'dw-resume' ),
		'license-status-unknown' => __( 'License status is unknown. %3$sCheck your license key here%4$s', 'dw-resume' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'dw-resume' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'dw-resume' ),
	)

);
