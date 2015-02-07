<?php
/*
Plugin Name: Recomended For You
Plugin URI: http://codeholic.in/
Description: Shows "Recomended for you"
Version: 0.9
Author: Pramod Jodhani
Author URI: http://codeholic.in/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.htmls
*/

define("RFY_SLUG" , "recommended-for-you");

$rfy_settings = get_option("rfy_settings");

function rfy_activate() {

	global $rfy_settings;

	$defaults = array(
					'version' 				=> 0.9,
					'enabled'				=> 'yes',
					'enabled_btn'			=> 'yes',
				);

	$rfy_settings = wp_parse_args( $rfy_settings, $defaults );	

	update_option("rfy_settings" , $rfy_settings);

}

register_activation_hook( __FILE__, 'rfy_activate' );

require "rfy-functions.php";
require "rfy-admin.php";
require "rfy-front-end.php";