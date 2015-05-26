<?php
/**
 * Created by PhpStorm.
 * User: jupassamani
 * Date: 15-05-26
 * Time: 12:49 PM
 */

function new_deck_settings_page() {
    $semantic = WP_PLUGIN_URL . '/panomanager/css/semantic.css';
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new deck!</h2>
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
    <input type="hidden" name="action" value="create_new_deck" />
    <div class="ui form segment new_deck_form">
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="deck_name">Deck Name</label>
	    		<input name="deck_name" id="name" required />
     	 	</div>
	      </div>
	    </div>
	    <?php submit_button(); ?>
	</div>
</form>
</div>
<?php }