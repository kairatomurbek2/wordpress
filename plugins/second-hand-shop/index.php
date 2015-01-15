<?php
/*
Plugin Name: Second Hand Shop
Plugin URI:
Description: plugin for creating the Second Hand Store
Version: 1
Author: it-attractor
Author URI: http://it-attractor.com/
*/


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}


define( 'SECOND_HAND_SHOP__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SECOND_HAND_SHOP__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


require_once( SECOND_HAND_SHOP__PLUGIN_DIR . 'functions.php' );
