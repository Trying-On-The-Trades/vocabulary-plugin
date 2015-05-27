<?php

// Build the settings page
function new_flash_card_game_settings_page() {
    $semantic = WP_PLUGIN_URL . '/panomanager/css/semantic.css';

    $domains   = get_domains();
    $categories = get_categories();
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new word!</h2>
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
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="create_new_word" />
    <div class="ui form segment new_word_form">
	    <div class="ui form">
	      <div class="field">
	        <label for="domain_id">Select a Domain</label>
	        <select name="domain_id">
				 <option value="NA">...</option>
                 <?php foreach($domains as $domain): ?>
        <option value="<?php echo $domain->id ?>"><?php echo $domain->name ?></option>
    <?php endforeach; ?>
			</select>
	      </div>
	    </div>
    <div class="ui form">
	      <div class="field">
	        <label for="category_id">Select a Category</label>
	        <select name="category_id">
				 <option value="NA">...</option>
                 <?php foreach($categories as $category): ?>
        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
    <?php endforeach; ?>
			</select>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="words_name">Word Name</label>
	    		<input type="text" name="words_name" id="name" required />
     	 	</div>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="words_description">Description</label>
	        <textarea name="words_description" required ></textarea>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_description">Points per word</label>
	         <select name="words_points">
	            <option value="30">30</option>
	            <option value="20">20</option>
	            <option value="10">10</option>
            </select>
	      </div>
	    </div>
       <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="words_image">Image</label>
	    		<input type="text" name="words_image" id="image"  />
     	 	</div>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="words_audio">Audio</label>
	    		<input type="text" name="words_audio" id="audio"  />
     	 	</div>
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
</script>
<?php }