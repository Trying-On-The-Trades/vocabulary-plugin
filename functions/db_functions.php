<?php

//create and update deck word

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

function get_word_categories(){
    global $wpdb;

    $word_category_table_name = get_word_categories_table_name();

    $word_categories = $wpdb->get_results(
        "SELECT * FROM " . $word_category_table_name . " wpt ");

    return $word_categories;
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


function get_domain($domain_id){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    $domain = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $domain_table_name . " wpt " .
        "WHERE wpt.id = %d", $domain_id)
    );

    return $domain;
}

function get_word_category($word_category_id){
    global $wpdb;
    $word_category_table_name = get_word_categories_table_name();

    $word_category = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $word_category_table_name . " wpt " .
        "WHERE wpt.id = %d", $word_category_id)
    );

    return $word_category;
}

function get_deck($deck_id){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $deck = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $deck_table_name . " wpt " .
        "WHERE wpt.id = %d", $deck_id)
    );

    return $deck;
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

function update_word($word_id, $word_word, $word_description, $word_points, $word_image, 
                    $word_audio, $word_domain_id, $word_word_category_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    if(isset($word_id) && is_numeric($word_id)){
        $wpdb->update( $word_table_name,
            array('word' => $word_word),
            array('description' => $word_description),
            array('points' => $word_points),
            array('image' => $word_image),
            array('audio' => $word_audio),
            array('domain_id' => $word_domain_id),
            array('word_category_id' => $word_word_category_id),
            array('id' => $word_id));

        return true;
    } else {
        return false;
    }
}

function update_domain($domain_id, $domain_name){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    if(isset($domain_id) && is_numeric($domain_id)){
        $wpdb->update( $domain_table_name,
            array('name' => $domain_name),
            array('id' => $domain_id));

        return true;
    } else {
        return false;
    }
}

function update_word_category($word_category_id, $word_category_name){
    global $wpdb;
    $word_category_table_name = get_word_categories_table_name();

    if(isset($word_category_id) && is_numeric($word_category_id)){
        $wpdb->update( $word_category_table_name,
            array('name' => $word_category_name),
            array('id' => $word_category_id));

        return true;
    } else {
        return false;
    }
}

function update_deck($deck_id, $deck_name, $deck_image, $deck_number_of_words){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    if(isset($deck_id) && is_numeric($deck_id)){
        $wpdb->update( $deck_table_name,
            array('name' => $deck_name),
            array('image' => $deck_image),
            array('number_of_words' => $deck_number_of_words),
            array('id' => $deck_id));

        return true;
    } else {
        return false;
    }
}

function create_word($word_word, $word_description, $word_points, $word_audio, 
                    $word_image, $word_domain_id, $word_word_category_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $wpdb->insert( $word_table_name, array( 'word' => $word_word),
        array( 'description' => $word_description),
        array('points' => $word_points),
        array('audio' => $word_audio),
        array('image' => $word_image),
        array( 'domain_id' => $word_domain_id),
        array('word_category_id' => $word_word_category_id));

    return $wpdb->insert_id;
}

function create_domain($domain_name){
    global $wpdb;
    $domain_table_name = get_domains_table_name();

    $wpdb->insert( $domain_table_name, array( 'name' => $domain_name));

    return $wpdb->insert_id;
}

function create_word_category($word_category_name){
    global $wpdb;
    $word_category_table_name = get_word_categories_table_name();

    $wpdb->insert( $word_category_table_name, array( 'name' => $word_category_name));

    return $wpdb->insert_id;
}

function create_deck($deck_name, $deck_image, $deck_number_of_words){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $wpdb->insert( $deck_table_name, array( 'name' => $deck_name), 
        array('image' => $deck_image), array('number_of_words' => $deck_number_of_words));

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

function delete_word_category($word_category_id){
    global $wpdb;
    $word_category_table_name = get_word_categories_table_name();

    $wpdb->delete( $word_category_table_name, array( 'id' => $word_category_id ) );
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
