<?php

// These are functions that get called when the plugin is installed for the first time. These are for setting up the database and handlers.

// Create the table to hold the API keys
function wordpleh_install () {
   global $wpdb;

   $installed_ver = get_option( "pano_db_version" );
   $table_name = get_dictionary_table_name();

  if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name || $installed_ver != pano_DB_VERSION ) {

    // Create tables
    
    $build_word_categories_sql      = build_word_categories_sql();
    $build_dictionary_sql           = build_dictionary_sql();
    $build_decks_sql                = build_decks_sql();
    $build_deck_words_sql           = build_deck_words_sql();

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    // Run the sql for the database
    dbDelta( $build_word_categories_sql );
    dbDelta( $build_dictionary_sql      );
    dbDelta( $build_decks_sql           );
    dbDelta( $build_deck_words_sql      );


    update_option( "pano_db_version", PANO_DB_VERSION );
    // create_first_row();
  }
}

// End of Install functions