<?php

// Build the settings page
function edit_spotgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $game_id = filter_input(INPUT_POST,'id');

    $game    = get_deck($game_id);

    $domains  = get_domains();
    $categories = get_word_categories();

    $words = get_words();

    $decks = get_decks('flashcard');

    //Will be empty if it's a copy or
    //Will have the id if it's an update
    $game_id_to_form = "";

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $game = build_deck($_GET['id']);

        $deck_words = get_number_of_words_for_game($_GET['id']);
    }

    $selected_words_ids = array($deck_words->number_of_words);


    //echo var_dump($selected_words_ids);

//    for($j = 0; $j < sizeof($deck_words); $j++){
//        $selected_words_ids[$j] = $deck_words[$j]->id;
//    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a Game!</h2>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Game updated successfully.</p></div>
    <?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
        <div class="error"><p>Error updating game.</p></div>
    <?php endif; ?>
<form id="form" method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_spotgame" />

    <?php
    if(isset($_GET['action']) && $_GET['action'] == "edit"){
        $game_id_to_form = $game->get_id();
    }elseif(isset($_GET['action']) && $_GET['action'] == "copy"){
        $game_id_to_form = "copy";
    }
    ?>

    <input type="hidden" name="game_id" value="<?= $game_id_to_form ?>"/>
    <div class="ui form segment edit_word_form">

        <div class="ui form">
        <div class="field">
            <label>Choose a Deck:</label>
            <select name="decks" id="deck_id">
				 <option value="NA">Select a Deck</option>
                 <?php foreach($decks as $deck): ?>
                    <option value="<?php echo $deck->id ?>"><?php echo $deck->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
       </div>

	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="game_name">Question that will display in the game: </label>
	    		<input name="game_name" id="name" value="<?php echo $game->get_name() ?>" required />
     	 	</div>
	      </div>
	    </div>

	    <p class="error" id="not_enough_words">* Select just one word</p>

	    <div class="ui form">
	      <div class="field">
	        <label for="category_id">Filter by</label>
	        <select name="domain_id" id="domain_id">
				 <option value="NA">Select a Domain</option>
                 <?php foreach($domains as $domain): ?>
        <option value="<?php echo $domain->id ?>"><?php echo $domain->name ?></option>
    <?php endforeach; ?>
            </select>
	        <select name="category_id" id="category_id">
				 <option value="NA">Select a Category</option>
                 <?php foreach($categories as $category): ?>
        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
    <?php endforeach; ?>
            </select>
          </div>
        </div>

         <div class="ui form">
	      <div class="field">
	        <ul>
                <?php foreach($words as $word): ?>
        <?php if(in_array($word->id, $selected_words_ids)): ?>
            <li class="games_form">
                <input type="checkbox" id="<?php echo $word->id ?>" class="dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>" checked>
                <label for="<?php echo $word->id ?>" class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>" ><?php echo $word->word ?></label>
            </li>
        <?php else :?>
            <li class="games_form">
                <input type="checkbox" id="<?php echo $word->id ?>" class="dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>">
                <label for="<?php echo $word->id ?>" class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>" ><?php echo $word->word ?></label>
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

<script>
    jQuery('#form').submit(function(e){
        user_selected_enough_words(e);
    });

    jQuery('#game_number_of_words').change(function(){
        document.getElementById("words_error").style.display = "none";
    });

    jQuery("input:checkbox").change(function(){
       document.getElementById("words_error").style.display = "none";
       document.getElementById("not_enough_words").style.display = "none";
    });

    jQuery("#category_id").change(function(){
        filter_words();
    });

    jQuery("#domain_id").change(function(){
        filter_words();
    });

    function user_selected_enough_words(e){
        var n = jQuery("input:checkbox:checked").length;
        var game_number_of_words = jQuery('#game_number_of_words').prop('value');

        if(n > 1 || n < 1){
            e.preventDefault();
            document.getElementById("not_enough_words").style.display = "block";
            document.getElementById("words_error").style.display = "none";
        }
        else if(n < Number(game_number_of_words)){
            e.preventDefault();
            document.getElementById("words_error").style.display = "block";
            document.getElementById("not_enough_words").style.display = "none";
        }else{
            document.getElementById("words_error").style.display = "none";
            document.getElementById("not_enough_words").style.display = "none";
        }

    }

    function filter_words()
    {
        var cat_selected = jQuery( "#category_id option:selected" ).val();
        var dom_selected = jQuery( "#domain_id option:selected" ).val();

        var checkboxes = jQuery("input:checkbox");

        jQuery(".cat_option").hide();
        //jQuery("input:checkbox").hide();

        if(cat_selected == "NA" && dom_selected == "NA")
        {
            jQuery(".cat_option").show();
        }
        else if(cat_selected != "NA" && dom_selected == "NA")
        {
            jQuery(".cat_option").hide();
            jQuery(".cat" + cat_selected).show();

            var category = "cat" + cat_selected;

            for(var k = 0; k < checkboxes.length; k++){
                if(!checkboxes[k].classList.contains(category)){
                   checkboxes[k].checked = false;
                }
            }
        }
        else if(cat_selected == "NA" && dom_selected != "NA")
        {
            jQuery(".cat_option").hide();
            jQuery(".dom" + dom_selected).show();

            var domain = "dom" + dom_selected;

            for(var k = 0; k < checkboxes.length; k++){
                if(!checkboxes[k].classList.contains(domain)){
                   checkboxes[k].checked = false;
                }
            }
        }
        else
        {
            jQuery(".cat_option").hide();
            jQuery(".dom" + dom_selected + ".cat" + cat_selected).show();

            var category = "cat" + cat_selected;

            for(var k = 0; k < checkboxes.length; k++){
                if(!checkboxes[k].classList.contains(category)){
                   checkboxes[k].checked = false;
                }
            }

            var domain = "dom" + dom_selected;

            for(var k = 0; k < checkboxes.length; k++){
                if(!checkboxes[k].classList.contains(domain)){
                   checkboxes[k].checked = false;
                }
            }
        }
        jQuery("input:checkbox").hide();


    }


</script>

<?php }
