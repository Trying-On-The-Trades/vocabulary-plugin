<?php

//create and update deck word

function get_words(){
    global $wpdb;

    $word_table_name = get_dictionary_table_name();

    $words = $wpdb->get_results(
        "SELECT * FROM " . $word_table_name . " wpt ");

    return $words;
}


function get_all_game_words($deck_id){
    global $wpdb;

    $word_table_name = get_dictionary_table_name();
    $deck_word_table_name = get_deck_words_table_name();

    $words = $wpdb->get_results(
        "SELECT word, description, image, audio, points
         FROM " . $word_table_name . " wpt " .
        "WHERE id IN (SELECT dictionary_id FROM " . $deck_word_table_name ." WHERE deck_id = " . $deck_id .")");


    return $words;
}

function get_number_of_words_for_game($deck_id){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $deck_number_words = $wpdb->get_row( $wpdb->prepare(
        "SELECT number_of_words FROM " . $deck_table_name . " wpt " .
        "WHERE wpt.id = %d", $deck_id)
    );

    return $deck_number_words;
}

function get_hatpleh_words($deck_id)
{
    global $wpdb;

    $word_table_name = get_dictionary_table_name();
    $deck_word_table_name = get_deck_words_table_name();
    $deck_table_name = get_decks_table_name();

    $words = $wpdb->get_results(
        "SELECT wdic.word, wdic.description, wdic.points, wdec.name, wdec.image
          FROM {$word_table_name} wdic
          INNER JOIN {$deck_word_table_name} wdecw
          ON wdic.id = wdecw.dictionary_id
          INNER JOIN {$deck_table_name} wdec
          ON wdec.id = wdecw.deck_id
          WHERE wdec.id = {$deck_id}");


    return $words;
}

function get_all_game_words_ids($deck_id){
    global $wpdb;

    $word_table_name = get_dictionary_table_name();
    $deck_word_table_name = get_deck_words_table_name();

    $words_ids = $wpdb->get_results(
        "SELECT id
         FROM " . $word_table_name . " wpt " .
        "WHERE id IN (SELECT dictionary_id FROM " . $deck_word_table_name ." WHERE deck_id = " . $deck_id .")");


    return $words_ids;
}

function get_word_categories(){
    global $wpdb;

    $word_category_table_name = get_word_categories_table_name();

    $word_categories = $wpdb->get_results(
        "SELECT * FROM " . $word_category_table_name . " wpt ");

    return $word_categories;
}


function get_hatgame_deck(){
    return get_decks('hatgame');
}

function get_flashcard_deck(){
    return get_decks("flashcard");
}

function get_decks($game_type){
    global $wpdb;

    $decks_table_name = get_decks_table_name();

    $sql = "SELECT * FROM {$decks_table_name} as wpt WHERE game_type like '{$game_type}'";
    $decks = $wpdb->get_results($sql);

    return $decks;
}

function get_deck_words($deck_id){
    global $wpdb;

    $table_name = get_deck_words_table_name();

    $sql = "SELECT * FROM {$table_name} AS wpt WHERE game_type = {$deck_id}";
    $deck_words = $wpdb->get_results($sql);

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
function get_words_details(){
    global $wpdb;

    $word_table_name = get_dictionary_table_name();
    $domain_table_name = get_domain_table_name();
    $word_category_table_name = get_word_categories_table_name();

    $words = $wpdb->get_results( $wpdb->prepare(
        "SELECT * FROM " . $word_table_name . " AS word, " . $domain_table_name .
        " AS domain , " . $word_category_table_name . " AS category " .
        "WHERE word.domain_id = domain.id AND word.word_category_id = category.id")
    );

    return $words;
}

function get_word_details($word_id){
    global $wpdb;

    $word_table_name = get_dictionary_table_name();
    $domain_table_name = get_domain_table_name();
    $word_category_table_name = get_word_categories_table_name();

    $word = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $word_table_name . " AS word, " . $domain_table_name .
        " AS domain , " . $word_category_table_name . " AS category " .
        "WHERE word.domain_id = domain.id AND word.word_category_id = category.id" .
        "AND word.id = {$word_id}")
    );

    return $word;
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

function update_word($word_id, $word_word, $word_description, $word_points,
                     $word_domain_id, $word_word_category_id, $word_image = null, $word_audio = null){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $params = array(
        'word' => $word_word,
        'description' => $word_description,
        'points' => $word_points,
        'domain_id' => $word_domain_id,
        'word_category_id' => $word_word_category_id,
    );

    if ($word_image !== null){
        $params['image'] =  $word_image;
    }

    if ($word_audio !== null){
        $params['audio'] = $word_audio;
    }
    if(isset($word_id) && is_numeric($word_id)){
        $wpdb->update( $word_table_name, $params , array('id' => $word_id));

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
            array(
            'name' => $word_category_name),
            array(
            'id' => $word_category_id));

        return true;
    } else {
        return false;
    }
}

function update_deck($deck_id, $deck_name, $deck_image = null, $deck_number_of_words, $deck_type){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    if(isset($deck_id) && is_numeric($deck_id)){
        $params = array(
            'name' => $deck_name,
            'number_of_words' => $deck_number_of_words,
            'game_type' => $deck_type);

        if ($deck_image !== null){
            $params['image'] =  $deck_image;
        }
        $wpdb->update( $deck_table_name, $params,
            array('id' => $deck_id)
            );


        return true;
    } else {
        return false;
    }
}

function create_word($word_word, $word_description, $word_points, $word_image, $word_audio,
                      $word_domain_id, $word_word_category_id){

    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $wpdb->insert( $word_table_name, array(
        'word' => $word_word,
        'description' => $word_description,
        'points' => $word_points,
        'image' => $word_image,
        'audio' => $word_audio,
        'domain_id' => $word_domain_id,
        'word_category_id' => $word_word_category_id));

    return $wpdb->insert_id;
}

function create_word_category($word_category_name){
    global $wpdb;
    $word_category_table_name = get_word_categories_table_name();

    $wpdb->insert( $word_category_table_name, array( 'name' => $word_category_name));

    return $wpdb->inser_id;
}

function create_deck($deck_name, $deck_image = null, $deck_number_of_words= null, $deck_type){
    global $wpdb;
    $deck_table_name = get_decks_table_name();

    $wpdb->insert( $deck_table_name, array(
        'name' => $deck_name,
        'image' => $deck_image, 
        'number_of_words' => $deck_number_of_words,
        'game_type' => $deck_type));

    return $wpdb->insert_id;
}

function create_deck_word($deck_id, $dictionary_id){
    global $wpdb;
    $table_name = get_deck_words_table_name();

    $wpdb->insert( $table_name, array(
        'deck_id' => $deck_id,
        'dictionary_id' => $dictionary_id));

    return $wpdb->insert_id;//REDO
}

function delete_word($word_id){
    global $wpdb;
    $word_table_name = get_dictionary_table_name();

    $wpdb->delete( $word_table_name, array( 'id' => $word_id ) );
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

    $wpdb->delete( $table_name, array(
        'deck_id' => $deck_id,
        'dictionary_id' => $dictionary_id));
}

function delete_deck_word_by_deck($deck_id){
    global $wpdb;
    $table_name = get_deck_words_table_name();

    $wpdb->delete( $table_name, array(
        'deck_id' => $deck_id));
}