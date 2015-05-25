<?php
// Functions used to build the pano table name and sql

// Get the table prefix and return the name
function get_dictionary_table_name(){
  global $wpdb;
  return $wpdb->prefix . "wordpleh_dictionary";
}

function get_trades_table_name(){
  global $wpdb;
  return $wpdb->prefix . get_word_prefix();
}

function get_categories_table_name(){
  global $wpdb;
  return $wpdb->prefix . "wordpleh_category";
}

function get_decks_table_name(){
  global $wpdb;
  return $wpdb->prefix . "wordpleh_deck";
}

function build_dictionary_sql(){
  $table_name = get_dictionary_table_name();

  $sql = 'CREATE TABLE `' . $table_name .'` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `word` char(50) NOT NULL,
    `description` varchar(225) NOT NULL,
    `image` char(30),
    `audio` char(30),
    `points` integer(10),
    `trade_id` int(11),
    `category_id` int(11),
    PRIMARY KEY (`id`),
    FOREIGN KEY (trade_id) REFERENCES ' . get_trades_table_name() . '(id),
    FOREIGN KEY (category_id) REFERENCES wp_wordpleh_category(id)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

    return $sql;
}

function build_trades_sql(){
  $table_name = get_trades_table_name();

  $sql = 'CREATE TABLE `' . $table_name . '` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `image` varchar(255) NOT NULL,
    `profession` char(30) NOT NULL,
    PRIMARY KEY(`id`)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

    return $sql;
}

function build_categories_sql(){
  $table_name = get_categories_table_name();

  $sql = 'CREATE TABLE `' . $table_name . '` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` char(50) NOT NULL,
    PRIMARY KEY(`id`)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

    return $sql;
}

function build_decks_sql(){
  $table_name = get_decks_table_name();

  $sql = 'CREATE TABLE `' . $table_name . '` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` char(50) NOT NULL,
    PRIMARY KEY(`id`)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';;

  return $sql;
}
