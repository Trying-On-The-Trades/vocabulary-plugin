<?php
function edit_category_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $category    = null;

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $category = build_category($_GET['id']);
    }
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new category!</h2>
<hr>
<style type="text/css">

</style>
<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>category updated successfully.</p></div>
    <?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
        <div class="error"><p>Error updating category.</p></div>
    <?php endif; ?>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="edit_category" />
    <input type="hidden" name="category_id" value="<?php echo $category->get_id(); ?>" />
    <div class="ui form segment new_category_form">
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="category_name">category Name</label>
	    		<input name="category_name" id="profession" value="<?php echo $category->get_name(); ?>" required />
     	 	</div>
	      </div>
	    </div>
	    <?php submit_button(); ?>
	</div>
</form>
</div>
<?php }