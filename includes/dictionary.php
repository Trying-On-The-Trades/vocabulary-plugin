<?php

class dictionary{

    protected $id,
              $word,
              $description,
              $image,
              $audio,
              $points,
              $trade_id,
              $word_category_id,
              $exists   = 0;

    function __construct($id = 1){
        if (is_numeric($id)){
            $dictionary_row = get_word($id);
            $this->build($dictionary_row);
        }
    }

    function build($dictionary_row){
        if ($dictionary_row->id > 0){
            $this->exists      = 1;
            $this->id          = $dictionary_row->id;
            $this->word        = $dictionary_row->word;
            $this->description = $dictionary_row->description;
            $this->image       = $dictionary_row->image;
            $this->audio       = $dictionary_row->audio;
            $this->points      = $dictionary_row->points;
            $this->trade_id    = $dictionary_row->trade_id;
            $this->word_category_id = $dictionary_row->word_category_id;
        }
    }

    function get_id(){
        return $this->id;
    }

    function get_word(){
        return $this->word;
    }

    function get_description(){
        return $this->description;
    }

    function get_image(){
        return $this->image;
    }

    function get_audio(){
        return $this->audio;
    }

    function get_points(){
        return $this->points;
    }

    function get_trade_id(){
        return $this->trade_id;
    }

    function get_word_category_id(){
        return $this->word_category_id;
    }
}