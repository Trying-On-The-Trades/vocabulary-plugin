<?php

class term{

    protected $id,
              $word,
              $hint,
              $trade_id,
              $exists   = 0;

    function __construct($id = 1){
        if (is_numeric($id)){
            $term_row = get_term($id);
            $this->build($term_row);
        }
    }

    function build($term_row){
        if ($term_row->id > 0){
            $this->exists   = 1;
            $this->id       = $term_row->id;
            $this->word     = $term_row->word;
            $this->hint     = $term_row->hint;
            $this->trade_id = $term_row->tarde_id;
        }
    }

    function get_id(){
        return $this->id;
    }

    function get_word(){
        return $this->word;
    }

    function get_hint(){
        return $this->hint;
    }
    function get_trade_id(){
        return $this->trade_id;
    }
}