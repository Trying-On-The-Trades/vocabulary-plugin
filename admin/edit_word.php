<?php

// Build the settings page
function edit_word_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $word_id = filter_input(INPUT_POST,'id');

    $words    = get_word($word_id);

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $words = build_words($_GET['id']);
    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a word!</h2>
<hr>
<style type="text/css">

</style>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
    <div class="updated"><p>Dictionary updated successfully.</p></div>
<?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
    <div class="error"><p>Error updating dictionary.</p></div>
<?php endif; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_word" />
    <input type="hidden" name="word_id" value="<?= $words->get_id(); ?>"/>

    <div class="ui form segment edit_word_form">
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
	        <textarea name="word_description" required ><?php echo $words->get_description() ?></textarea>
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
	        <label for="word_image">Image</label>
	        <input name="word_image" id="image" value="<?php echo $words->get_image() ?>" />
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="word_audio">Audio</label>
	        <input name="word_audio" id="audio" value="<?php echo $words->get_audio() ?>" />
	      </div>
	    </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>

    <script>
        jQuery(document).ready(function(){
            jQuery("#wordTable").tablesorter();
        })
    </script>
<?php }