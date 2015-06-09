<?php

// Build the settings page
function new_word_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

	$domains   = get_domains();
    $categories = get_word_categories();
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new word!</h2>
<hr>
<style type="text/css">
	#domain_form{
	    display: none;
	    width: 80%;
	    margin: 0 auto;
	}
</style>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
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
	        	<label for="word_name">Word Name</label>
	    		<input type="text" name="word_name" id="name" required />
     	 	</div>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="word_description">Description</label>
	        <textarea name="word_description" required ></textarea>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="word_description">Total <?= get_points_name_plural() ?>:</label>
	         <select name="word_points">
	            <option value="30">30</option>
	            <option value="20">20</option>
	            <option value="10">10</option>
            </select>
	      </div>
	    </div>
       <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="word_image">Choose a image <b>(Preferably 120x120)</b></label>
	    		<input type="file" name="word_image" id="word_image"  />
     	 	</div>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="word_audio">Audio</label>
	    		<input type="file" name="word_audio" id="word_audio"  />
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
    function addForm() {
        document.getElementById("buttonDomain").style.display = "none";
        document.getElementById("domain_form").style.display = "block";
    }


</script>
<?php }