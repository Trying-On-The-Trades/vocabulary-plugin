<?php

class deck_words{

    protected $deck_id,
              $dictionary_id,
              $exists   = 0;

    function __construct($deck_id = 1, $dictionary_id = 1){
        if (is_numeric($deck_id) && is_numeric($dictionary_id)){
            $deck_word_row = get_deck($deck_id, $dictionary_id);
            $this->build($deck_word_row);
        }
    }

    function build($deck_word_row){
        if ($trade_row->deck_id > 0 && $trade_row->dictionary_id > 0){
            $this->exists        = 1;
            $this->deck_id       = $deck_word_row->deck_id;
            $this->dictionary_id = $deck_word_row->dictionary_id;
        }
    }

    function get_deck_id(){
        return $this->deck_id;
    }

    function get_dictionary_id(){
        return $this->dictionary_id;
    }
}