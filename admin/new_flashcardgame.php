<?php

// Build the settings page
function new_flashcardgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $domains   = get_domains();
    $categories = get_word_categories();
    $words = get_words();

?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create New Game!</h2>
<hr>
<style type="text/css">
	#domain_form{
	    display: none;
	    width: 80%;
	    margin: 0 auto;

	}
</style>
<form id="form" method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <input type="hidden" name="action" value="create_new_flashcard" />
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
	        	<label for="game_number_of_words">Defined number of words to be guessed: </label>
	    		<input name="game_number_of_words" id="game_number_of_words" required />
     	 	</div>
	      </div>
	    </div>

	    <p class="error" id="words_error">* Number of words in the game can not be lower than words selected</p>
	    <p class="error" id="not_enough_words">* Must select at least 4 words</p>

        <div class="ui form">
	      <div class="field">
	        <label for="domain_id">Filter by</label>
	        <select name="domain_id" id="domain_id">
				 <option value="NA">Select a Domain</option>
                 <?php foreach($domains as $domain): ?>
                    <option value="<?php echo $domain->id ?>"><?php echo $domain->name ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="ui form">
	      <div class="field">
	        <label for="category_id">Filter by</label>
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
                        <input type="checkbox" id="<?php echo $word->id ?>" class="cat<?php echo $word->word_category_id ?>" name="words[]" value="<?php echo $word->id ?>">
                        <label for="<?php echo $word->id ?>" class="cat_option cat<?php echo $word->word_category_id ?>" ><?php echo $word->word ?></label>
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

    jQuery("#category_id").change(function(){
        filter_words();
    });

    function user_selected_enough_words(e){
        var n = jQuery("input:checkbox:checked").length;
        var game_number_of_words = jQuery('#game_number_of_words').prop('value');

        if(n < 4){
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

        function filter_words(){

        var selected = jQuery( "#category_id option:selected" ).val();


        if(selected == "NA"){
            jQuery(".cat_option").show();
            jQuery("input:checkbox").hide();
        }else{
            jQuery(".cat_option").hide();
            var category = ".cat" + selected;

            jQuery(category).show();
            jQuery("input:checkbox").hide();
        }


    }


</script>
<?php }