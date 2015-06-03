<?php

// Build the settings page
function edit_flashcardgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $game_id = filter_input(INPUT_POST,'id');

    $game    = get_deck($game_id);

    $domains  = get_domains();
    $categories = get_categories();

    $words = get_words();



    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $game = build_deck($_GET['id']);
        $deck_words = get_all_game_words_ids($_GET['id']);
    }

    $selected_words_ids = array();

    for($j = 0; $j < sizeof($deck_words); $j++){
        $selected_words_ids[$j] = $deck_words[$j]->id;
    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a Game!</h2>
<hr>
<style type="text/css">
	#wpfooter{
		display: none;
	}

	#file_input {
	    border: 1px solid #cccccc;
	    padding: 5px;
	}

	.new_pano_form{
		width:85%;
		margin: 0px auto;
	}
</style>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Game updated successfully.</p></div>
    <?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
        <div class="error"><p>Error updating game.</p></div>
    <?php endif; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_flashcard" />
    <input type="hidden" name="game_id" value="<?= $game->get_id(); ?>"/>
    <div class="ui form segment edit_word_form">

	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="game_name">Game Name: </label>
	    		<input name="game_name" id="name" value="<?php echo $game->get_name() ?>" required />
     	 	</div>
	      </div>
	    </div>

	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="game_number_of_words">Defined number of words to be guessed: </label>
	    		<input name="game_number_of_words" id="name" value="<?php echo $game->get_number_of_words() ?>" required />
     	 	</div>
	      </div>
	    </div>

         <div class="ui form">
	      <div class="field">
	        <ul>
                <?php foreach($words as $word): ?>
                    <?php if(in_array($word->id, $selected_words_ids)): ?>
                        <li class="games_form">
                            <input type="checkbox" id="<?php echo $word->id ?>" class="<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>" checked>
                            <label for="<?php echo $word->id ?>"><?php echo $word->word ?></label>
                        </li>
                    <?php else :?>
                        <li class="games_form">
                            <input type="checkbox" id="<?php echo $word->id ?>" class="<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>">
                            <label for="<?php echo $word->id ?>"><?php echo $word->word ?></label>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
	      </div>
        </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>

<?php }