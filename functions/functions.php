<?php

    function build_words($word_id = 1){

        $word = new dictionary($word_id);
        return $word;
    }

    function build_deck($deck_id = 1){

        $deck = new deck($deck_id);
        return $deck;
    }

    function build_category($category_id = 1){

        $category = new word_category($category_id);
        return $category;
    }

    function process_new_word(){

        if ( isset( $_FILES['word_image'] ) ) {

            $file = wp_upload_bits( $_FILES['word_image']['name'], null, @file_get_contents( $_FILES['word_image']['tmp_name'] ) );
            $image = $_FILES['word_image']['name'];
            if ( FALSE === $file['error'] ) {
                // TODO
            }
        }


        if ( isset( $_FILES['word_audio'] ) ) {

            $file = wp_upload_bits( $_FILES['word_audio']['name'], null, @file_get_contents( $_FILES['word_audio']['tmp_name'] ) );
            $audio = $_FILES['word_audio']['name'];
            if ( FALSE === $file['error'] ) {
                // TODO
            }
        }
        // Create a new word using the post data
        $word_word              = $_POST['word_name'];
        $word_description       = trim($_POST['word_description']);
        $word_points            = $_POST['word_points'];
        $word_image             = $image;
        $word_audio             = $audio;
        $word_domain_id         = $_POST['domain_id'];
        $word_word_category_id  = $_POST['category_id'];

        // Get the id
        create_word($word_word, $word_description, $word_points, $word_image, $word_audio, $word_domain_id, $word_word_category_id);

        wp_redirect( admin_url( 'admin.php?page=word_menu' ) );
    }

    function process_new_category(){

        // Create a new category using the post data
        $word_category_name              = $_POST['category_name'];

        create_word_category($word_category_name);

        wp_redirect( admin_url( 'admin.php?page=category_settings' ) );
    }

    function process_new_flashcard(){ 

        // Create a new flashcard game
        $flashcard_name         = $_POST['game_name'];
        $flashcard_image        = "";
        $flashcard_num_of_words = $_POST['game_number_of_words'];
        $game_type              = "flashcard";

        $selected_words = $_POST['words'];

        $deck_id = create_deck($flashcard_name, $flashcard_image, $flashcard_num_of_words, $game_type);

        if(!empty($selected_words)){
            foreach($selected_words as $word){
                create_deck_word($deck_id, $word);
            }
        }


        wp_redirect( admin_url( 'admin.php?page=flashcardgame_settings' ) );
    }

    function process_new_deck_word($deck_id, $word_id){
        create_deck_word($deck_id, $word_id);
    }

    function process_edit_word(){

        if ( isset ($_POST['word_image_tmp']) &&  $_POST['word_image_tmp'] != ""){
            $image = $_POST['word_image_tmp'];

        }else{
            if ( isset( $_FILES['word_image'] ) ) {

                $file = wp_upload_bits( $_FILES['word_image']['name'], null, @file_get_contents( $_FILES['word_image']['tmp_name'] ) );
                $image = $_FILES['word_image']['name'];
                if ( FALSE === $file['error'] ) {
                    // TODO
                }
            }
        }


        if ( isset ($_POST['word_audio_tmp']) &&  $_POST['word_audio_tmp'] != ""){
            $audio = $_POST['word_audio_tmp'];

        }else {
            if (isset($_FILES['word_audio'])) {

                $file = wp_upload_bits($_FILES['word_audio']['name'], null, @file_get_contents($_FILES['word_audio']['tmp_name']));
                $audio = $_FILES['word_audio']['name'];
                if (FALSE === $file['error']) {
                    // TODO
                }
            }
        }

        // Edit an existing word using the post data
        $word_id                = $_POST['word_id'];
        $word_word              = $_POST['word_name'];
        $word_description       = trim($_POST['word_description']);
        $word_points            = $_POST['word_points'];
        $word_image             = $image;
        $word_audio             = $audio;
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

    function process_edit_category(){

        // Edit an existing category using the post data
        $word_category_id            = $_POST['category_id'];
        $word_category_name          = $_POST['category_name'];

        $return = update_word_category($word_category_id, $word_category_name );

        if($return){
            wp_redirect( admin_url( 'admin.php?page=category_settings&settings-saved') );
        } else {
            wp_redirect( admin_url( 'admin.php?page=category_settings&error') );
        }
    }

    function process_edit_flashcard(){ 

        // Edit a flashcard game
        $flashcard_id           = $_POST['game_id'];
        $flashcard_name         = $_POST['game_name'];
        $flashcard_image        = "";
        $flashcard_num_of_words = $_POST['game_number_of_words'];
        $game_type              = "flashcard";

        $return = update_deck($flashcard_id, $flashcard_name, $flashcard_image, $flashcard_num_of_words, $game_type);

        $selected_words = $_POST['words'];

        delete_deck_word_by_deck($flashcard_id);

        if(!empty($selected_words)){
            foreach($selected_words as $word){
                create_deck_word($flashcard_id, $word);
            }
        }

        if($return){
            wp_redirect( admin_url( 'admin.php?page=flashcardgame_settings&settings-saved') );
        } else {
            wp_redirect( admin_url( 'admin.php?page=flashcardgame_settings&error') );
        }
    }

    function process_delete_word(){

        // Delete a word using the post data
        $word_id = $_POST['word_id'];

        delete_word($word_id);

        wp_redirect( admin_url( 'admin.php?page=word_menu') );
    }

    function process_delete_category(){

        // Delete a category using the post data
        $word_category_id = $_POST['category_id'];

        delete_word_category($word_category_id);

        wp_redirect( admin_url( 'admin.php?page=category_settings') );
    }

    function process_delete_deck(){

        // Delete a word using the post data
        $deck_id = $_POST['game_id'];

        delete_deck($deck_id);

        wp_redirect( admin_url( 'admin.php?page=flashcardgame_settings') );
    }





