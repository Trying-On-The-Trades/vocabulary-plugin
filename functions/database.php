<?php
// Functions used to build the pano table name and sql

// Get the table prefix and return the name
function get_dictionary_table_name(){
    global $wpdb;
    return $wpdb->prefix . "wordpleh_dictionary";
}

function get_domain_table_name(){
    global $wpdb;
    return $wpdb->prefix . "pano_domain";
}

function get_word_categories_table_name(){
    global $wpdb;
    return $wpdb->prefix . "wordpleh_word_category";
}

function get_decks_table_name(){
    global $wpdb;
    return $wpdb->prefix . "wordpleh_deck";
}

function get_deck_words_table_name(){
    global $wpdb;
    return $wpdb->prefix . "worpleh_deck_words";
}

function build_dictionary_sql(){
    $table_name = get_dictionary_table_name();

    $sql = 'CREATE TABLE `' . $table_name .'` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `word` char(50) NOT NULL,
    `description` varchar(225) NOT NULL,
    `image` varchar(80),
    `audio` varchar(80),
    `points` integer(10),
    `domain_id` int(11) NOT NULL,
    `word_category_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (domain_id) REFERENCES ' . get_domain_table_name() . '(id),
    FOREIGN KEY (word_category_id) REFERENCES ' . get_word_categories_table_name() . '(id)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

    return $sql;
}

function build_word_categories_sql(){
  $table_name = get_word_categories_table_name();

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
    `image` char(50),
    `number_of_words` int(10),
    `game_type` char(50),
    PRIMARY KEY(`id`)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

  return $sql;
}

function build_deck_words_sql(){
  $table_name = get_deck_words_table_name();

  $sql = 'CREATE TABLE `' . $table_name . '` (
    `deck_id` int(10) NOT NULL,
    `dictionary_id` int(10) NOT NULL,
    PRIMARY KEY (deck_id, dictionary_id),
    FOREIGN KEY (deck_id) REFERENCES ' . get_decks_table_name() . '(id) ON DELETE CASCADE,

    FOREIGN KEY (dictionary_id) REFERENCES ' . get_dictionary_table_name() . '(id) ON DELETE CASCADE
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;';
  return $sql;
}
