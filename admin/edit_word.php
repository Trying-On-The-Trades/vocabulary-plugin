<?php

// Build the settings page
function edit_word_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';

    $word_id = filter_input(INPUT_POST,'id');

    $words    = get_word($word_id);
    $domains  = get_domains();
    $categories = get_categories();

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $words = build_words($_GET['id']);
    }

    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Edit a word!</h2>
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
    <div class="updated"><p>Dictionary updated successfully.</p></div>
<?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
    <div class="error"><p>Error updating dictionary.</p></div>
<?php endif; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_word" />
    <input type="hidden" name="words_id" value="<?= $words->get_id(); ?>"/>
<!--	    <div class="ui form">-->
<!--	      <div class="field">-->
<!--	        <label for="prereq_domain_id">Select a domain</label>-->
<!--	        <select name="domain_id">-->
<!--				 <option value="NA">...</option>-->
<!--                 --><?php //foreach($domains as $domain): ?>
<!--					<option value="--><?php //echo $domain->id ?><!--" --><?php //echo ($domain->id === $words->get_domain_id()) ? "selected" : "" ?><!-->--><?php //echo $domain->name ?><!--</option>-->
<!--				 --><?php //endforeach; ?>
<!--			</select>-->
<!--	      </div>-->
<!--	    </div>-->
<!--	    <div class="ui form">-->
<!--	      <div class="field">-->
<!--	        <label for="prereq_category_id">Select a category</label>-->
<!--	        <select name="category_id">-->
<!--				 <option value="NA">...</option>-->
<!--                 --><?php //foreach($categories as $category): ?>
<!--                     <option value="--><?php //echo $category->id ?><!--" --><?php //echo ($category->id === $words->get_category_id()) ? "selected" : "" ?><!-->--><?p6hp //echo $category->name ?><!--</option>-->
<!--                 --><?php //endforeach; ?>
<!--			</select>-->
<!--	      </div>-->
<!--	    </div>-->
    <div class="ui form segment edit_word_form">
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="words_name">Word Name</label>
	    		<input name="words_name" id="name" value="<?php echo $words->get_word() ?>" required />
     	 	</div>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="words_description">Description</label>
	        <textarea name="words_description" required ><?php echo $words->get_description() ?></textarea>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_points">Points</label>
	        <select name="words_points">
	            <option value="30">30</option>
	            <option value="20">20</option>
	            <option value="10">10</option>
            </select>
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_image">Image</label>
	        <input name="words_image" id="image" value="<?php echo $words->get_image() ?>" />
	      </div>
	    </div>
        <div class="ui form">
	      <div class="field">
	        <label for="words_audio">Audio</label>
	        <input name="words_audio" id="audio" value="<?php echo $words->get_audio() ?>" />
	      </div>
	    </div>

	    <?php submit_button(); ?>
	</div>
</form>
</div>

<!--<script>-->
<!--	jQuery(document).ready(function(){-->
<!--		jQuery("#pano_id").change(function(){-->
<!--			var quest_id = jQuery("option:selected", this).attr("data-quest-id");-->
<!--			jQuery("#quest_id").val(quest_id);-->
<!--		});-->
<!--	});-->
<!--</script>-->
<?php }