<?php

// Build the settings page
function prereq_new_settings_page() {
    $semantic = WP_PLUGIN_URL . '/panomanager/css/semantic.css';
    $trades   = get_trades();

    $pano_id = null;
    if(isset($_GET['pano_id']) && is_numeric($_GET['pano_id'])){
        $pano_id = $_GET['pano_id'];
    }
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<h2>Create a new Prereq!</h2>
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
    <input type="hidden" name="action" value="create_new_prereq" />
    <input type="hidden" name="pano_id" value="<?php echo $pano_id ?>" />
    <div class="ui form segment new_prereq_form">
	    <div class="ui form">
	      <div class="field">
	      	<div class="ui left labeled icon input">
	        	<label for="prereq_pts">Prereq Points</label>
	    		<input type="number" name="prereq_pts" id="prereq_pts" placeholder="100" required />
     	 	</div>
	      </div>
	    </div>
	    <div class="ui form">
	      <div class="field">
	        <label for="prereq_trade_id">Select a Prereq Trade</label>
	        <select name="prereq_trade_id">
	             <option value="NA">...</option>
                 <?php foreach($trades as $trade): ?>
                     <option value="<?php echo $trade->id ?>"><?php echo $trade->name ?></option>
                 <?php endforeach; ?>
			</select>
	      </div>
	    </div>
	    <?php submit_button(); ?>
	</div>
</form>
</div>
<?php }