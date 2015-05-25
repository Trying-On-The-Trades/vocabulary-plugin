<?php
// Functions used to build the pano table name and sql

// Get the table prefix and return the name
function get_terms_table_name(){
  global $wpdb;
  return $wpdb->prefix . "wordpleh_dictionary";
}

function get_trades_table_name(){
  global $wpdb;
  return $wpdb->prefix . get_word_prefix();
}


function build_terms_sql(){
  $table_name = get_terms_table_name();

  $sql = 'CREATE TABLE `' . $table_name .'` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `word` char(50) NOT NULL,
    `hint` varchar(225) NOT NULL,
    `trade_id` int(11),
    PRIMARY KEY (`id`),
    FOREIGN KEY (trade_id) REFERENCES wp_pano_trade_type(id)
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
