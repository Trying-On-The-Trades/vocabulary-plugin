<?php

//create and update deck word
function get_trades_prefix(){
  global $wpdb;
  $table_name = $wpdb->prefix . "pano_trades"
  $sql = "SHOW TABLES LIKE '" . $table_name ."'";
  $table = $wpdb->get_results($sql);
  $exists = $table->num_rows;
  if($exists === 0)
    return false;
  else 
    return true;
}

function get_words(){
    global $wpdb;
    
    $word_table_name = get_dictionary_table_name();

    $words = $wpdb->get_results( 
            "SELECT * FROM " . $word_table_name . " wpt ");

    return $words;
}

function get_trades(){
    global $wpdb;
    
    $trade_table_name = get_trades_table_name();

    $trades = $wpdb->get_results( 
            "SELECT * FROM " . $trade_table_name . " wpt ");

    return $trades;
}

function get_categories(){
  global $wpdb;

  $category_table_name = get_categories_table_name();

  $categories = $wpdb->get_results( 
            "SELECT * FROM " . $category_table_name . " wpt ");

  return $categories;
}

function get_decks(){
  global $wpdb;

  $decks_table_name = get_decks_table_name();

  $decks = $wpdb->get_results( 
            "SELECT * FROM " . $decks_table_name . " wpt ");

  return $decks;
}

function get_deck_words(){
  global $wpdb;

  $table_name = get_deck_words_table_name();

  $deck_words = $wpdb->get_results(
                  "SELECT * FROM " . $table_name . "wpt");

  return $deck_words;
}

function get_word($word_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $word = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $word_table_name . " wpt " .
        "WHERE wpt.id = %d", $word_id)
    );

    return $word;
}

function get_word_with_trade($word_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();
    $trade_table_name = get_trades_table_name();

    $word = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $trade_table_name . " AS trade, " . $word_table_name .
        "AS words WHERE trade.id = words.trade_id AND words.id = " . $word_id})
    );

    return $word;
}

function get_trade($trade_id){
    global $wpdb;
    $trade_table_name = get_trades_table_name();

    $trade = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $trade_table_name . " wpt " .
        "WHERE wpt.id = %d", $trade_id)
    );

    return $trade;
}

function get_category($category_id){
    global $wpdb;
    $category_table_name = get_categories_table_name();

    $category = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $category_table_name . " wpt " .
        "WHERE wpt.id = %d", $category_id)
    );

    return $trade;
}

function get_deck($deck_id){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $deck = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $deck_table_name . " wpt " .
        "WHERE wpt.id = %d", $deck_id)
    );

    return $trade;
}

function get_deck_word($deck_id, $dictionary_id){
  global $wpdb;
  $table_name = get_deck_words_table_name();
  $deck = $wpdb->get_row($wpdb->prepare(
    "SELECT * FROM " . $table_name . " wpt " .
    "WHERE wpt.deck_id = " . $deck_id . " AND 
    wpt.dictionary_id = " . $dictionary_id)
  );
}

function update_word($word_id, $word_word, $word_hint, $trade_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    if(isset($word_id) && is_numeric($word_id)){
        $wpdb->update( $word_table_name,
                       array('word' => $word_word),
                       array('hint' => $word_hint),
                       array('trade_id' => $trade_id),
                       array('id' => $word_id));

        return true;
    } else {
        return false;
    }
}

function update_trade($trade_id, $trade_profession, $trade_image){
    global $wpdb;
    $trade_table_name = get_trades_table_name();

    if(isset($trade_id) && is_numeric($trade_id)){
        $wpdb->update( $trade_table_name,
                       array('profession' => $trade_profession),
                       array('image' => $trade_image),
                       array('id' => $trade_id));

        return true;
    } else {
        return false;
    }
}

function update_category($category_id, $category_name){
  global $wpdb;
  $category_table_name = get_categories_table_name();

  if(isset($category_id) && is_numeric($category_id)){
      $wpdb->update( $category_table_name,
                     array('name' => $category_name),
                     array('id' => $category_id));

      return true;
  } else {
      return false;
  }
}

function update_deck($deck_id, $deck_name){
  global $wpdb;
  $deck_table_name = get_decks_table_name();

  if(isset($deck_id) && is_numeric($deck_id)){
      $wpdb->update( $deck_table_name,
                     array('name' => $deck_name),
                     array('id' => $deck_id));

      return true;
  } else {
      return false;
  }
}

function update_deck_word($deck_id, $dictionary_id){
  //DOO
}

function create_word($word_word, $word_hint, $trade_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $wpdb->insert( $word_table_name, array( 'word' => $word_word),
                                     array( 'hint' => $word_hint),
                                     array( 'trade_id' => $trade_id));

    return $wpdb->insert_id;
}

function create_trade($trade_profession, $trade_image){
    global $wpdb;
    $trade_table_name = get_trades_table_name();

    $wpdb->insert( $trade_table_name, array( 'profession' => $trade_name),
                                      array( 'image' => $trade_image));

    return $wpdb->insert_id;
}

function create_category($category_name){
    global $wpdb;
    $category_table_name = get_categories_table_name();

    $wpdb->insert( $category_table_name, array( 'name' => $category_name));

    return $wpdb->insert_id;
}

function create_deck($deck_name){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $wpdb->insert( $deck_table_name, array( 'name' => $deck_name));

    return $wpdb->insert_id;
}

function create_deck_word($deck_id, $dictionary_id){
  global $wpdb;
  $table_name = get_deck_words_table_name();

  $wpdb->insert( $table_name, array( 'deck_id' => $deck_id),
                              array('dictionary_id' => $dictionary_id));

  return $wpdb->insert_id;//REDO
}

function delete_word($word_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $wpdb->delete( $word_table_name, array( 'id' => $word_id ) );
}

function delete_trade($trade_id){
    global $wpdb;
    $trade_table_name = get_trades_table_name();

    $wpdb->delete( $trade_table_name, array( 'id' => $trade_id ) );
}

function delete_category($category_id){
    global $wpdb;
    $category_table_name = get_categories_table_name();

    $wpdb->delete( $category_table_name, array( 'id' => $category_id ) );
}

function delete_deck($deck_id){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $wpdb->delete( $deck_table_name, array( 'id' => $deck_id ) );
}

function delete_deck_word($deck_id, $dictionary_id){
  global $wpdb;
  $table_name = get_deck_words_table_name();

  $wpdb->delete( $table_name, array('deck_id' => $deck_id), 
                              array('dictionary_id' => $dictionary_id));
}