<?php

    function build_words($word_id = 1){

        $word = new dictionary($word_id);
        return $word;
    }

    function process_new_word(){

        // Create a new word using the post data
        $word_word              = $_POST['words_name'];
        $word_description       = trim($_POST['words_description']);
        $word_points            = $_POST['words_points'];
        $word_image             = $_POST['words_image'];
        $word_audio             = $_POST['words_audio'];
        $word_domain_id         = $_POST['domain_id'];
        $word_word_category_id  = $_POST['category_id'];
        $word_audio        = $_POST['words_audio'];
        $word_domain_id       = $_POST['domain_id'];
        $word_word_category_id       = $_POST['category_id'];

        // Get the id
        create_word($word_word, $word_description, $word_points, $word_image, $word_audio, $word_domain_id, $word_word_category_id);

        wp_redirect( admin_url( 'admin.php?page=word_menu' ) );
    }

    function process_edit_word(){

        // Create a new word using the post data
        $word_id                = $_POST['words_id'];
        $word_word              = $_POST['words_name'];
        $word_description       = trim($_POST['words_description']);
        $word_points            = $_POST['words_points'];
        $word_image             = $_POST['words_image'];
        $word_audio             = $_POST['words_audio'];
        $word_domain_id         = $_POST['domain_id'];
        $word_word_category_id  = $_POST['category_id'];

        // Get the id
        $return = update_word($word_id, $word_word, $word_description, $word_points, $word_image, $word_audio, $word_domain_id, $word_word_category_id);

        if($return){
            wp_redirect( admin_url( 'admin.php?page=word_menu&settings-saved') );
        } else {
            wp_redirect( admin_url( 'admin.php?page=word_menu&error') );
        }
    }

    function process_delete_word(){

        // Delete a word using the post data
        $word_id = $_POST['word_id'];

        delete_word($word_id);

        wp_redirect( admin_url( 'admin.php?page=word_menu') );
    }


