<?php

// Create the admin menu
function word_create_menu() {
	create_top_wordpleh_menu();
	create_sub_wordpleh_menus();
}

// function to create the top level meny
function create_top_wordpleh_menu(){
	add_menu_page('word-settings',
				  'WordPlã',
				  'administrator',
				  'word_menu',
				  'word_settings_page');
}

// function to create the sub menus
function create_sub_wordpleh_menus(){

	add_submenu_page("word_menu",
						"Word List",
						"Word List",
						"administrator",
						"word_settings",
						"word_settings_page");

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
        "Word Categories",
        "Word Categories",
        "administrator",
        "category_settings",
        "category_settings_page");

    add_submenu_page(null,
        "New Word Category",
        "New Word Category",
        "administrator",
        "new_category_settings",
        "new_category_settings_page");

    add_submenu_page(null,
        "Edit Word Category",
        "Edit Word Category",
        "administrator",
        "edit_category_settings",
        "edit_category_settings_page");

    add_submenu_page("word_menu",
        "Flash Card Decks",
        "Flash Card Decks",
        "administrator",
        "flashcardgame_settings",
        "flashcardgame_settings_page");

    add_submenu_page(null,
        "New Flash Card Deck",
        "New Flash Card Deck",
        "administrator",
        "new_flashcardgame_settings",
        "new_flashcardgame_settings_page");

    add_submenu_page(null,
        "Edit Flash Card Deck",
        "Edit Flash Card Deck",
        "administrator",
        "edit_flashcardgame_settings",
        "edit_flashcardgame_settings_page");

    add_submenu_page(null,
        "View Flash Card Deck",
        "View Flash Card Deck",
        "administrator",
        "view_flashcardgame_settings",
        "view_flashcardgame_settings_page");

    add_submenu_page("word_menu",
        "Spelling Games",
        "Spelling Games",
        "administrator",
        "hatplehgame_settings",
        "hatplehgame_settings_page");

    add_submenu_page(null,
        "New Spelling Game",
        "New Spelling Game",
        "administrator",
        "new_hatplehgame_settings",
        "new_hatplehgame_settings_page");

    add_submenu_page(null,
        "Edit Spelling Game",
        "Edit Spelling Game",
        "administrator",
        "edit_hatplehgame_settings",
        "edit_hatplehgame_settings_page");

    add_submenu_page(null,
        "View Spelling Game",
        "View Spelling Game",
        "administrator",
        "view_hatplehgame_settings",
        "view_hatplehgame_settings_page");

    add_submenu_page("word_menu",
        "Spot the Word Games",
        "Spot the Word Games",
        "administrator",
        "spotgame_settings",
        "spotgame_settings_page");

    add_submenu_page(null,
        "New Spot the Word Game",
        "New Spot the Word Game",
        "administrator",
        "new_spotgame_settings",
        "new_spotgame_settings_page");

    add_submenu_page(null,
        "Edit Spot the Word Game",
        "Edit Spot the Word Game",
        "administrator",
        "edit_spotgame_settings",
        "edit_spotgame_settings_page");

    add_submenu_page(null,
        "View Spot the Word Game",
        "View Spot the Word Game",
        "administrator",
        "view_spotgame_settings",
        "view_spotgame_settings_page");

    add_submenu_page(null,
        "New Hotspot",
        "New Hotspot",
        "administrator",
        "new_hotspot_editor_settings",
        "new_hotspot_editor_settings_page");

		remove_submenu_page("word_menu", "word_menu");

}
