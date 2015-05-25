<?php
function get_word_prefix(){
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
    
    $word_table_name = get_words_table_name();

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

function get_word($word_id){
    global $wpdb;
    $word_table_name = get_words_table_name();

    $word = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $word_table_name . " wpt " .
        "WHERE wpt.id = %d", $word_id)
    );

    return $word;
}

function get_word_with_trade($word_id){
    global $wpdb;
    $word_table_name = get_words_table_name();
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

function update_word($word_id, $word_word, $word_hint, $trade_id){
    global $wpdb;
    $word_table_name = get_words_table_name();

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

function create_word($word_word, $word_hint, $trade_id){
    global $wpdb;
    $word_table_name = get_words_table_name();

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

function delete_word($word_id){
    global $wpdb;
    $word_table_name = get_words_table_name();

    $wpdb->delete( $word_table_name, array( 'id' => $word_id ) );
}

function delete_trade($trade_id){
    global $wpdb;
    $trade_table_name = get_trades_table_name();

    $wpdb->delete( $trade_table_name, array( 'id' => $trade_id ) );
}