<?php

// Build the settings page
function new_spotgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $decks = get_decks('flashcard');
    $deck_words = get_deck_words('');
    $domains   = get_domains();
    $categories = get_word_categories();
    $words = get_words();

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create New Game!</h2>
<hr>

<form id="form" method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <input type="hidden" name="action" value="create_new_spotgame" />
    <div class="ui form segment new_word_form">

       <div class="ui form">
        <div class="field">
            <label>Choose a deck:</label>
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
	        	<label for="game_name">Create a question to display in the game: </label>
	    		<input name="game_name" id="name" required />
     	 	</div>
	      </div>
	    </div>

	    <p class="error" id="not_enough_words">* Select just one word</p>

       <div class="ui form">
	      <div class="field">
	        <label>Word to be guessed:</label>
	        <label for="filter">Filter by</label>
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
                <li class="games_form">
                    <input type="checkbox" id="<?php echo $word->id ?>" class="dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>">
                    <label for="<?php echo $word->id ?>" class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>" ><?php echo $word->word ?></label>
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

    jQuery('#form').submit(function(e){
        user_selected_enough_words(e);
    });

    jQuery('#game_number_of_words').change(function(){
        document.getElementById("words_error").style.display = "none";
        document.getElementById("not_enough_words").style.display = "none";
    });

    jQuery("input:checkbox").change(function(){
       document.getElementById("words_error").style.display = "none";
       document.getElementById("not_enough_words").style.display = "none";
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

    jQuery("#category_id").change(function(){
        filter_words();
    });

    jQuery("#domain_id").change(function(){
        filter_words();
    });

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

//    function filter_words(){
//
//        var selected        = jQuery( "#category_id option:selected" ).val();
//        var checkboxes = jQuery("input:checkbox");
//
//        if(!(selected == "NA")){
//            jQuery("label").hide();
//            var category = ".cat" + selected;
//
//            jQuery(category).show();
//            jQuery("input:checkbox").hide();
//
//            var category_selected = "";
//
//            for(var k = 0; k < checkboxes.length; k++){
//                category_selected = "." + checkboxes[k].className;
//                if(category_selected != category){
//                   checkboxes[k].checked = false;
//                }
//            }
//        }else{
//            jQuery("label").show();
//            jQuery("input:checkbox").hide();
//        }
//
//    }


</script>
<?php }