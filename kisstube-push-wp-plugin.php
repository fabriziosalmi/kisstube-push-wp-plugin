<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
Plugin Name: KissTube Push
Plugin URI: https://shop.kisstube.tv/product/wordpress-plugin
Description: KissTube Push: not annoying KissTube network ads platform.
Version: 0.1
Author: Fabrizio Salmi
Author URI: https://github.com/fabriziosalmi
License: GPL
*/

add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_options_page( 'KissTube Push settings', 'KissTube Push', 'manage_options', 'kisstube-push-wp-plugin', 'my_plugin_options' );
}

function your_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=kisstube-push-wp-plugin.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'your_plugin_settings_link' );

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';

	echo '<h2>KissTube Push</h2>';
	echo '<p>KissTube Push successfully installed: the ad network is currently <span style="color: #00b300;font-weight: bold;">enabled</span> on your website.</p>';
        echo '<p>Edit the <span style="font-weight:bold;">kisstube-push</span> class to customize the outline style and the 468x60 ad position.</p>';
}

add_action('wp_footer', 'kisstube_push');

function kisstube_push($wp_footer) {

        $kpcode = wp_remote_retrieve_body( wp_remote_get("https://shop.kisstube.tv/api/code"));
	echo $kpcode;
}

?>
