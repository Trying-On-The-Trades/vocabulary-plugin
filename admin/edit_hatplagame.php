<?php

// Build the settings page
function edit_hatplagame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $game_id = filter_input(INPUT_POST,'id');
    $game    = get_deck($game_id);

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $game = build_deck($_GET['id']);
    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a Game!</h2>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Game updated successfully.</p></div>
    <?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
        <div class="error"><p>Error updating game.</p></div>
    <?php endif; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_hatgame" />
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
                <label for="word_image">Choose an image for winning the game: <b>(Preferably 120x120)</b></label>
                <img class="word_image" src="<?= content_url().'/'.$game->get_image() ?>" alt="Image"/>
                <input type="file" name="game_image" id="game_image"  />

	      </div>
	    </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>

<?php }