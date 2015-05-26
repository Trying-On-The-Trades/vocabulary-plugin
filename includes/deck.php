<?php

class deck{

    protected $id,
              $name,
              $image,
              $number_of_words,
              $exists   = 0;

    function __construct($id = 1){
        if (is_numeric($id)){
            $deck_row = get_deck($id);
            $this->build($deck_row);
        }
    }

    function build($deck_row){
        if ($deck_row_row->id > 0){
            $this->exists          = 1;
            $this->id              = $deck_row->id;
            $this->name            = $deck_row->name;
            $this->image           = $deck_row->image;
            $this->number_of_words = $deck_row->number_of_words;
        }
    }

    function get_id(){
        return $this->id;
    }

    function get_name(){
        return $this->name;
    }

    function get_image(){
        return $this->image;
    }

    function get_number_of_words(){
        return $this->number_of_words;
    }
}