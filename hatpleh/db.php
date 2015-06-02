<?php
	define('DB_HOST','localhost');
    define('DB_USER','wordpress');
    define('DB_PASS','wordpress');
    define('DB_NAME','wordpress');

    function database_connection()
    {
    	return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    function select_words($db, $deck_id)
    {
        $query = "SELECT dictionary.word, dictionary.description, deck.image, deck.name 
                    FROM wp_wordpleh_dictionary AS dictionary, 
                        wp_wordpleh_deck_words AS deck_words, 
                        wp_wordpleh_deck AS deck
                    WHERE dictionary.id = deck_words.dictionary_id
                    AND deck_words.deck_id = deck.id
                    AND deck.id = {$deck_id};";
        $result = $db->query($query);
        $final = [];

        while($row = $result->fetch_object())
        {
            array_push($final, ['word' => $row->word,'description' => $row->description, 
                'image' => $row->image, 'profession' => $row->profession]);
        }
        return $final;
    }

?>