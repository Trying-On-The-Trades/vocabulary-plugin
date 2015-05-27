<?php

// Uninstall functions to clean up the database if the pano manager plugin is removed

function wordpleh_uninstall() {
  global $wpdb;

  // Get all the table names
  $deck_word_table_name = get_deck_words_table_name();
  $dictionary_table_name = get_dictionary_table_name();
  $deck_table_name = get_decks_table_name();
  $word_category_table_name = get_word_categories_table_name();


  // Drop all the tables
  $wpdb->query( "DROP TABLE IF EXISTS {$deck_word_table_name}" );
  $wpdb->query( "DROP TABLE IF EXISTS {$dictionary_table_name}" );
  $wpdb->query( "DROP TABLE IF EXISTS {$deck_table_name}" );
  $wpdb->query( "DROP TABLE IF EXISTS {$word_category_table_name}" );


  // Update the db version to 0 so the next time the plugin is run it will reinstall
  update_option( "panno_db_version", PANO_DB_VERSION );
}

// Hook is commented out so we don't lose data for now
register_uninstall_hook( __FILE__, 'wordpleh_uninstall' );

// End of Uninstall