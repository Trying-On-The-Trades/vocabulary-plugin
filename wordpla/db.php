<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','wordpress');

function database_connection()
{
    return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}

function get_all_game_words($db, $deck_id){

    $word_table_name = 'wp_wordpleh_dictionary';
    $deck_word_table_name = 'wp_worpleh_deck_words';
    $deck_table_name = 'wp_wordpleh_deck';
    $final = array();

    $rows = $db->query(
        "SELECT wdic.word, wdic.description, wdic.points, wdic.audio, wdic.image
              FROM {$word_table_name} wdic
              INNER JOIN {$deck_word_table_name} wdecw
              ON wdic.id = wdecw.dictionary_id
              INNER JOIN {$deck_table_name} wdec
              ON wdec.id = wdecw.deck_id
              WHERE wdec.id = {$deck_id}");

    while($row = $rows->fetch_object())
    {
        array_push($final, array('word' => $row->word,'description' => $row->description,
            'points' => $row->points, 'audio' => $row->audio, 'image' => $row->image));
    }

    return $final;
}

function get_number_of_words_for_game($db, $deck_id){

    $deck_table_name = 'wp_wordpleh_deck';
    $final = "";

    $rows = $db->query(
        "SELECT number_of_words FROM {$deck_table_name}
        WHERE id = $deck_id");

    while($row = $rows->fetch_object())
    {
        $final = $row->number_of_words;
    }

    return $final;
}

function get_deck_title($db, $deck_id){

    $deck_table_name = 'wp_wordpleh_deck';
    $final = "";

    $rows = $db->query(
        "SELECT name FROM {$deck_table_name}
        WHERE id = $deck_id");

    while($row = $rows->fetch_object())
    {
        $final = $row->name;
    }

    return $final;
}

?>