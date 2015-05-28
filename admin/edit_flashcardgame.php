<?php

// Build the settings page
function edit_flashcardgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $game_id = filter_input(INPUT_POST,'id');

    $games    = get_deck($game_id);
    $domains  = get_domains();
    $categories = get_categories();

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $games = build_words($_GET['id']);
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
    <input type="hidden" name="action" value="edit_game" />
    <input type="hidden" name="games_id" value="<?= $games->get_id(); ?>"/>
    <div class="ui form segment edit_word_form">
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="games_name">Word Name</label>
	    		<input name="games_name" id="name" value="<?php echo $games->get_name() ?>" required />
     	 	</div>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="words_description">Description</label>
	        <textarea name="words_description" required ><?php echo $games->get_image() ?></textarea>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="words_description">Description</label>
	        <textarea name="words_description" required ><?php echo $games->get_number_of_words() ?></textarea>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_points">Points</label>
	        <select name="words_points">
	            <option value="30">30</option>
	            <option value="20">20</option>
	            <option value="10">10</option>
            </select>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_image">Image</label>
	        <input name="words_image" id="image" value="<?php echo $games->get_image() ?>" />
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_audio">Audio</label>
	        <input name="words_audio" id="audio" value="<?php echo $games->get_audio() ?>" />
	      </div>
	    </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>

<!--<script>-->
<!--	jQuery(document).ready(function(){-->
<!--		jQuery("#pano_id").change(function(){-->
<!--			var quest_id = jQuery("option:selected", this).attr("data-quest-id");-->
<!--			jQuery("#quest_id").val(quest_id);-->
<!--		});-->
<!--	});-->
<!--</script>-->
<?php }