<?php

// Build the settings page
function pano_word_settings_page() {
    $words = get_words();

    $semantic         = WP_PLUGIN_URL . '/panomanager/css/semantic.css';
    $new_word_url  = admin_url() . "admin.php?page=new_word_settings";
    $edit_word_url = admin_url() . "admin.php?page=edit_word_settings";
    ?>

<!-- style sheet so our admin page looks nice -->
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<p>Manage your words!</p>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
    <div class="updated"><p>Settings updated successfully.</p></div>
<?php endif ?>

<h2>Words</h2>
<table id="wordTable" class="ui table segment tablesorter">
    <thead>
      <tr>
        <th>Word</th>
        <th>Description</th>
        <th>Image</th>
        <th>Audio</th>
        <th>Domain</th>
        <th>Category</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
        <?php foreach ($words as $word): ?>
            <?php $current_word = build_word($word->word_id); ?>
            <tr>
                <td><?php echo $current_word->get_name() ?></td>
                <td><?php echo $current_word->get_description() ?></td>
                <td><?php echo $current_word->get_image() ?></td>
                <td><?php echo $current_word->get_audio() ?></td>
                <td><?php echo $current_word->get_domain_profession() ?></td>
                <td><?php echo $current_word->get_category_name() ?></td>
                <td><a class="ui blue icon button" href="<?php echo $edit_word_url ?>&id=<?php echo $current_word->get_id() ?>" style="padding: 7px">Edit</a></td>
                <td>
                    <form method="post" action="admin-post.php" id="delete_word_form<?php echo $current_word->get_id() ?>">
                        <!-- pano processing hook -->
                        <input type="hidden" name="action" value="delete_word" />
                        <input type="hidden" name="word_id" value="<?php echo $current_word->get_id() ?>" />

                        <input type="submit" class="ui blue icon button" value="Delete" style="padding: 7px" >
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a class="ui blue icon button" href="<?php echo $new_word_url ?>" style="padding: 7px">New Word</a>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery("#wordTable").tablesorter();
    })
</script>

<?php }