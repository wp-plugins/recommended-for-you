<?php

function rfy_scripts() {
	wp_enqueue_script( 'jquery.cookie', plugins_url( 'js/jquery.cookie.js', __FILE__ ), array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'rfy_script', plugins_url( 'js/rfy_script.js', __FILE__ ), array( 'jquery' ), '1.0.0', false );
	wp_enqueue_style( 'rfy_style', plugins_url( 'css/rfy_style.css', __FILE__ ), array(), '1.0.0' );
}

add_action( 'wp_enqueue_scripts', 'rfy_scripts' );