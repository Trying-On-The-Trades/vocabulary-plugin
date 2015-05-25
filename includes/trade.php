<?php

class trade{

    protected $id,
              $profession,
              $image,
              $exists   = 0;

    function __construct($id = 1){

        // Get the Quest (Skill) based on the id
        if (is_numeric($id)){
            $trade_row = get_trade($id);
            $this->build($trade_row);
        }
    }

    function build($trade_row){
        if ($trade_row->id > 0){
            $this->exists     = 1;
            $this->id         = $trade_row->id;
            $this->profession = $trade_row->profession;
            $this->image      = $trade_row->image;
        }
    }

    function get_id(){
        return $this->id;
    }

    function get_profession(){
        return $this->profession;
    }

    function get_image(){
        return $this->image;
    }
}