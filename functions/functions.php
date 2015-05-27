<?php

    function build_words($word_id = 1){

        $word = new dictionary($word_id);
        return $word;
    }

    function process_new_word(){

        // Create a new word using the post data
        $word_word          = $_POST['words_name'];
        $word_description   = trim($_POST['words_description']);
        $word_points        = $_POST['words_points'];
        $word_image         = $_POST['words_image'];
        $words_audio        = $_POST['words_audio'];


        // Get the id
        create_word($word_word, $word_description, $word_points, $word_image, $words_audio);

        wp_redirect( admin_url( 'admin.php?page=word_settings' ) );
    }

    function process_edit_word(){

        // Create a new word using the post data
        $word_id            = $_POST['word_id'];
        $word_word          = $_POST['words_name'];
        $word_description   = trim($_POST['words_description']);
        $word_points        = $_POST['words_points'];
        $word_image         = $_POST['words_image'];
        $words_audio        = $_POST['words_audio'];

        // Get the id
        $return = update_word($word_id, $word_word, $word_description, $word_points, $word_image, $words_audio);

        if($return){
            wp_redirect( admin_url( 'admin.php?page=word_settings&settings-saved') );
        } else {
            wp_redirect( admin_url( 'admin.php?page=word_settings&error') );
        }
    }

    function process_delete_word(){

        // Delete a word using the post data
        $word_id = $_POST['word_id'];

        delete_word($word_id);

        wp_redirect( admin_url( 'admin.php?page=word_settings') );
    }


