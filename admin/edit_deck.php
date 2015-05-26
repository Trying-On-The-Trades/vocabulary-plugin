<?php
/**
 * Created by PhpStorm.
 * User: jupassamani
 * Date: 15-05-26
 * Time: 12:44 PM
 */

function edit_deck_settings_page() {
    $semantic = WP_PLUGIN_URL . '/panomanager/css/semantic.css';

    $decks    = get_decks();

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $decks = build_decks($_GET['id']);
    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a deck!</h2>
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

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Deck updated successfully.</p></div>
    <?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
        <div class="error"><p>Error updating deck.</p></div>
    <?php endif; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_decks" />
    <div class="ui form segment new_pano_form">
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="decks_name">Deck Name</label>
	    		<input name="decks_name" id="name" value="<?php echo $decks->get_deck() ?>" required />
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