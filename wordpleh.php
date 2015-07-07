<?php

/*
Plugin Name: wordplã
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
 add_action( 'admin_menu', 'word_create_menu');
// add_action( 'admin_enqueue_scripts', 'plu_admin_enqueue');


// Add the process word hook
add_action( 'admin_post_create_new_word', 'process_new_word' );
add_action( 'admin_post_edit_word', 'process_edit_word' );
add_action( 'admin_post_delete_word', 'process_delete_word' );

// Add the process category hook
add_action( 'admin_post_create_new_category', 'process_new_category' );
add_action( 'admin_post_edit_category', 'process_edit_category' );
add_action( 'admin_post_delete_category', 'process_delete_category' );

// Add the process flashcard game hook
add_action( 'admin_post_create_new_flashcard', 'process_new_flashcard' );
add_action( 'admin_post_edit_flashcard', 'process_edit_flashcard' );
add_action( 'admin_post_delete_deck', 'process_delete_deck' );

// Add the process hat game hook
add_action( 'admin_post_create_new_hatgame', 'process_new_hatgame' );
add_action( 'admin_post_edit_hatgame', 'process_edit_hatgame' );
add_action( 'admin_post_delete_deck', 'process_delete_deck' );

//Add the process spot game hook
add_action( 'admin_post_create_new_spotgame', 'process_new_spotgame' );
add_action( 'admin_post_edit_spotgame', 'process_edit_spotgame' );
add_action( 'admin_post_delete_deck', 'process_delete_deck' );


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
//require_once("admin/admin_page.php");

require_once("admin/new_word.php");
require_once("admin/edit_word.php");
require_once("admin/words.php");
//require_once("admin/admin_page.php");

require_once("admin/new_category.php");
require_once("admin/edit_category.php");
require_once("admin/categories.php");

require_once("admin/new_flashcardgame.php");
require_once("admin/edit_flashcardgame.php");
require_once("admin/flashcardgames.php");
require_once("admin/view_flashcardgame.php");

require_once("admin/new_hatplehgame.php");
require_once("admin/edit_hatplehgame.php");
require_once("admin/hatplehgames.php");
require_once("admin/view_hatplehgame.php");

require_once("admin/new_spotgame.php");
require_once("admin/edit_spotgame.php");
require_once("admin/spotgames.php");
require_once("admin/view_spotgame.php");

require_once("admin/hotspot_editor.php");

require_once("admin/view_panos.php");
