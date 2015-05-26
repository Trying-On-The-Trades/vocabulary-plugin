<?php

//create and update deck word
function get_domains_prefix(){
  global $wpdb;
  $table_name = $wpdb->prefix . "pano_domains"
  $sql = "SHOW TABLES LIKE '" . $table_name ."'";
  $table = $wpdb->get_results($sql);
  $exists = $table->num_rows;
  if($exists === 0)
    return "wordpleh_domains";
  else 
    return "pano_domains";
}

function get_words(){
    global $wpdb;
    
    $word_table_name = get_dictionary_table_name();

    $words = $wpdb->get_results( 
            "SELECT * FROM " . $word_table_name . " wpt ");

    return $words;
}

function get_domains(){
    global $wpdb;
    
    $domain_table_name = get_domains_table_name();

    $domains = $wpdb->get_results( 
            "SELECT * FROM " . $domain_table_name . " wpt ");

    return $domains;
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

function get_word_with_domain($word_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();
    $domain_table_name = get_domains_table_name();

    $word = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $domain_table_name . " AS domain, " . $word_table_name .
        "AS words WHERE domain.id = words.domain_id AND words.id = " . $word_id})
    );

    return $word;
}

function get_domain($domain_id){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    $domain = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $domain_table_name . " wpt " .
        "WHERE wpt.id = %d", $domain_id)
    );

    return $domain;
}

function get_category($category_id){
    global $wpdb;
    $category_table_name = get_categories_table_name();

    $category = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $category_table_name . " wpt " .
        "WHERE wpt.id = %d", $category_id)
    );

    return $domain;
}

function get_deck($deck_id){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $deck = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $deck_table_name . " wpt " .
        "WHERE wpt.id = %d", $deck_id)
    );

    return $domain;
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

function update_word($word_id, $word_word, $word_hint, $domain_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    if(isset($word_id) && is_numeric($word_id)){
        $wpdb->update( $word_table_name,
                       array('word' => $word_word),
                       array('hint' => $word_hint),
                       array('domain_id' => $domain_id),
                       array('id' => $word_id));

        return true;
    } else {
        return false;
    }
}

function update_domain($domain_id, $domain_profession, $domain_image){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    if(isset($domain_id) && is_numeric($domain_id)){
        $wpdb->update( $domain_table_name,
                       array('profession' => $domain_profession),
                       array('image' => $domain_image),
                       array('id' => $domain_id));

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

function create_word($word_word, $word_hint, $domain_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $wpdb->insert( $word_table_name, array( 'word' => $word_word),
                                     array( 'hint' => $word_hint),
                                     array( 'domain_id' => $domain_id));

    return $wpdb->insert_id;
}

function create_domain($domain_profession, $domain_image){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    $wpdb->insert( $domain_table_name, array( 'profession' => $domain_name),
                                      array( 'image' => $domain_image));

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

function delete_domain($domain_id){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    $wpdb->delete( $domain_table_name, array( 'id' => $domain_id ) );
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