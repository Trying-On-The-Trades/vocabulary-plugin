<?php

/*
Plugin Name: wordpleh
Plugin URI: http://dan-blair.ca
Description: Manage your KR Panos
Version: 0.1.5
Author: Trying On The Trades
Author URI: http://www.tott.com
*/

// Originally developed by Dann Blair
// boldinnovationgroup.net

// Add jquery because we need that...
// $jquery_location = WP_PLUGIN_URL . "/panomanager/js/jquery.js";
// wp_register_script('jquery', $jquery_location, true);
// wp_enqueue_script('jquery');

// Require the important functions
require_once("functions/database.php");
require_once("functions/db_functions.php");
require_once("functions/functions.php");

require_once("functions/install.php");
//require_once("functions/uninstall.php");
require_once("functions/menu.php");

// Create the admin menu from menu.php
add_action( 'admin_menu', 'pano_create_menu');
add_action( 'admin_enqueue_scripts', 'plu_admin_enqueue');

// Activation hook to install the DB
register_activation_hook( __FILE__, 'wordpleh_install' );

// Version of the DB used
define( 'PANO_DB_VERSION', '1.1.6' );

// Require the objects
require_once("includes/deck.php");
require_once("includes/deck_words.php");
require_once("includes/dictionary.php");
require_once("includes/word_category.php");

// Require the admin pages
require_once("admin/admin_page.php");

require_once("admin/new_word.php");
require_once("admin/edit_word.php");
require_once("admin/words.php");



