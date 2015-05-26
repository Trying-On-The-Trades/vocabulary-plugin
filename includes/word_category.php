<?php

class word_category{

    protected $id,
              $name,
              $exists   = 0;

    function __construct($id = 1){

        // Get the Quest (Skill) based on the id
        if (is_numeric($id)){
            $word_category_row = get_word_category($id);
            $this->build($word_category_row);
        }
    }

    function build($word_category_row){
        if ($trade_row->id > 0){
            $this->exists   = 1;
            $this->id       = $trade_row->id;
            $this->name = $trade_row->name;
        }
    }

    function get_id(){
        return $this->id;
    }

    function get_name(){
        return $this->name;
    }
}