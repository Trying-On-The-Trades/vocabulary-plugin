<?php
	define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','root');
    define('DB_NAME','wordpress');

    function database_connection()
    {
    	return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    function get_hatpla_words($db, $deck_id)
    {
        $word_table_name = 'wp_wordpla_dictionary';
        $deck_word_table_name = 'wp_worpla_deck_words';
        $deck_table_name = 'wp_wordpla_deck';
        $final = array();

        $rows = $db->query(
            "SELECT wdic.word, wdic.description, wdic.points, wdec.name, wdec.image
              FROM {$word_table_name} wdic
              INNER JOIN {$deck_word_table_name} wdecw
              ON wdic.id = wdecw.dictionary_id
              INNER JOIN {$deck_table_name} wdec
              ON wdec.id = wdecw.deck_id
              WHERE wdec.id = {$deck_id}");

        while($row = $rows->fetch_object())
        {
            array_push($final, array('word' => $row->word,'description' => $row->description, 
                'points' => $row->points, 'name' => $row->name, 'image' => $row->image));
        }

        return $final;
    }

?>