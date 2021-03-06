<?php

// Build the settings page
function new_hotspot_editor_settings_page() {
    $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $missions = get_missions();
    $domains   = get_domains();
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new hotspot!</h2>
<hr>
<style type="text/css">
	.new_pano_form{
		width:85%;
		margin: 0px auto;
	}
</style>
<form method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
    <!-- pano processing hook -->
    <input type="hidden" name="action" value="create_new_hotspot" />
    <div class="ui form segment new_pano_form">
	    <div class="ui form">
	      <div class="field">
	        <label for="mission_id">Select a Mission</label>
	        <select name="mission_id">
                 <?php foreach($missions as $mission): ?>
                    <option value="<?php echo $mission->mission_id ?>"><?php echo $mission->name ?></option>
                 <?php endforeach; ?>
            </select>
	      </div>
	    </div>

        <div class="ui form">
	      <div class="field">
	        <label for="hotspot_domain_id">Select a Domain</label>
	        <select name="hotspot_domain_id">
				 <option value="NA">...</option>
                 <?php foreach($domains as $domain): ?>
                    <option value="<?php echo $domain->id ?>"><?php echo $domain->name ?></option>
                <?php endforeach; ?>
			</select>
	      </div>
	    </div>

	    <div class="ui form">
	      <div class="field">
	        <label for="hotspot_description">Hotspot Description</label>
	        <textarea name="hotspot_description" required ></textarea>
	      </div>
	    </div>

        <div class="ui form">
          <div class="field">
            <input type="checkbox" name="hotspot_icon" checked="true" />Apply image to hotspot
          </div>
        </div>

	    <?php submit_button(); ?>

</form>
</div>
<?php }