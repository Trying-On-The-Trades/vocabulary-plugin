<?php
// Build the settings page
function new_hatplehgame_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $categories = get_word_categories();
    $domains = get_domains();
    $words = get_words();

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new HatPlã game!</h2>
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
	        	<label for="word_image">Choose an image for winning the game: <b>(Preferably 120x120)</b></label>
	    		<input type="file" name="word_image" id="word_image" required/>
     	 	</div>
	      </div>
	    </div>

        <div class="ui form">
	      <div class="field">
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
    }
    else if(cat_selected == "NA" && dom_selected != "NA")
    {
        jQuery(".cat_option").hide();
        jQuery(".dom" + dom_selected).show();
    }
    else
    {
        jQuery(".cat_option").hide();
        jQuery(".dom" + dom_selected + ".cat" + cat_selected).show();
    }
    jQuery("input:checkbox").hide();
}
</script>
<?php }