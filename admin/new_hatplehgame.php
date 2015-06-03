<?php
// Build the settings page
function new_hatplehgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $domains   = get_domains();
    $categories = get_word_categories();
    $words = get_words();

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new HatPleh game!</h2>
<hr>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <input type="hidden" name="action" value="create_new_hatgame" />
    <div class="ui form segment new_word_form">

	   <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="game_name">Game Name: </label>
	    		<input name="game_name" id="name" required />
     	 	</div>
	      </div>
	    </div>

        <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="word_image">Choose an image for the hat in the game:</label>
	    		<input type="file" name="word_image" id="word_image"  />
     	 	</div>
	      </div>
	    </div>

	    <div class="ui form">
	      <div class="field">
	      <label>Choose witch words you want in the game:</label>
	        <ul>
                <?php foreach($words as $word): ?>
        <li class="games_form">
            <input type="checkbox" id="<?php echo $word->id ?>" class="<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>">
            <label for="<?php echo $word->id ?>"><?php echo $word->word ?></label>
        </li>
    <?php endforeach; ?>
            </ul>
	      </div>
        </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>

<script>
	jQuery(document).ready(function(){
		jQuery("#pano_id").change(function(){
			var quest_id = jQuery("option:selected", this).attr("data-quest-id");
			jQuery("#quest_id").val(quest_id);
		});
	});
    function addForm() {
        document.getElementById("buttonDomain").style.display = "none";
        document.getElementById("domain_form").style.display = "block";
    }


</script>
<?php }