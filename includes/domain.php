<?php

class domain{

    protected $id,
              $profession,
              $image,
              $exists   = 0;

    function __construct($id = 1){

        // Get the Quest (Skill) based on the id
        if (is_numeric($id)){
            $domain_row = get_domain($id);
            $this->build($domain_row);
        }
    }

    function build($domain_row){
        if ($domain_row->id > 0){
            $this->exists     = 1;
            $this->id         = $domain_row->id;
            $this->profession = $domain_row->profession;
            $this->image      = $domain_row->image;
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