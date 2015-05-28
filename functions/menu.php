<?php

// Create the admin menu
function word_create_menu() {
	create_top_wordpleh_menu();
	create_sub_wordpleh_menus();
}

// function to create the top level meny
function create_top_wordpleh_menu(){
	add_menu_page('word-settings', 
				  'Wordpleh',
				  'administrator',
				  'word_menu',
				  'word_settings_page');
}

// function to create the sub menus
function create_sub_wordpleh_menus(){

	// Create the sub menu item for new words
	add_submenu_page(null,
					 "New Word",
					 "New Word",
					 "administrator",
					 "new_word_settings",
					 "new_word_settings_page");

	// Create the sub menu item for editing words
	add_submenu_page(null,
					 "Edit Word",
					 "Edit Word",
					 "administrator",
					 "edit_word_settings",
					 "edit_word_settings_page");


    add_submenu_page("word_menu",
        "Category",
        "Category",
        "administrator",
        "category_settings",
        "category_settings_page");

    add_submenu_page(null,
        "New Category",
        "New Category",
        "administrator",
        "new_category_settings",
        "new_category_settings_page");

    add_submenu_page(null,
        "Edit Category",
        "Edit Category",
        "administrator",
        "edit_category_settings",
        "edit_category_settings_page");

    add_submenu_page("word_menu",
        "Flash Card Game",
        "Flash Card Game",
        "administrator",
        "flashcardgame_settings",
        "flashcardgame_settings_page");

    add_submenu_page(null,
        "New Flash Card Game",
        "New Flash Card Game",
        "administrator",
        "new_flashcardgame_settings",
        "new_flashcardgame_settings_page");

    add_submenu_page(null,
        "Edit Flash Card Game",
        "Edit Flash Card Game",
        "administrator",
        "edit_flashcardgame_settings",
        "edit_flashcardgame_settings_page");

//    // Create the sub menu item for  s
//    add_submenu_page("word_menu",
//        "Dictionary",
//        "Dictionary",
//        "administrator",
//        "word_settings",
//        "word_settings_page");
//
//    // Create the sub menu item for  s
//    add_submenu_page(null,
//        "New Word",
//        "New Word",
//        "administrator",
//        "new_word_settings",
//        "new_word_settings_page");
//
//    // Create the sub menu item for editng  s
//    add_submenu_page(null,
//        "Edit Mission",
//        "Edit Mission",
//        "administrator",
//        "edit_word_settings",
//        "edit_word_settings_page");
}