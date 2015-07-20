<?php

// Build the settings page
function edit_word_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $word_id = filter_input(INPUT_POST,'id');

    $words    = get_word($word_id);
    $domains   = get_domains();
    $categories = get_word_categories();

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $words = build_words($_GET['id']);
    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a word!</h2>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
    <div class="updated"><p>Dictionary updated successfully.</p></div>
<?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
    <div class="error"><p>Error updating dictionary.</p></div>
<?php endif; ?>
<form id="myform" method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_word" />
    <input type="hidden" name="word_id" value="<?= $words->get_id(); ?>"/>

    <div class="ui form segment edit_word_form">

        <div class="ui form">
              <div class="field">
                <label for="domain_id">Select a Domain</label>
                <select name="domain_id">
                     <option value="NA"> ... </option>
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
	    		<input name="word_name" id="name" value="<?php echo $words->get_word() ?>" required />
     	 	</div>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="word_description">Description</label>
	        <textarea name="word_description" id="word_description" required ><?php echo $words->get_description() ?></textarea>
            <p class="error" id="description_too_big">* Description must be smaller than 255 char</p>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="word_points">Points</label>
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
                <label for="word_image">Choose an image: <b>(Preferably 120x120)</b> </label>
                <img class="word_image" src="<?= content_url().'/'.$words->get_image() ?>" alt="Image"/>
                <input type="file" name="word_image" id="word_image"  />
            </div>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <div class="ui left labeled icon input">
                <label for="word_audio">Choose an audio: </label>
                <input type="file" name="word_audio" id="word_audio" />
	        </div>
	      </div>
	    </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>
<script>
    jQuery('#myform').submit(function(e){
       max_description_size(e);
   });

   function max_description_size(e){
       var size = jQuery("#word_description").val().length;
       if(size > 255){
           document.getElementById("description_too_big").style.display = "block";
           e.preventDefault();
       }else{
           document.getElementById("description_too_big").style.display = "none";
       }
   }
            jQuery(document).ready(function(){
                jQuery("#wordTable").tablesorter();
            })
</script>
<?php }