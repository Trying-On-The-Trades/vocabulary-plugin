<?php
/**
 * Created by PhpStorm.
 * User: jupassamani
 * Date: 15-05-26
 * Time: 12:53 PM
 */

function pano_deck_settings_page() {
    $decks = get_decks();

    $semantic       = WP_PLUGIN_URL . '/panomanager/css/semantic.css';
    $new_deck_url  = admin_url() . "admin.php?page=new_deck_settings";
    $edit_deck_url = admin_url() . "admin.php?page=edit_deck_settings";
    ?>

<!-- style sheet so our admin page looks nice -->
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<p>Manage your decks!</p>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Settings updated successfully.</p></div>
    <?php endif ?>

<h2>Domains</h2>
<table class="ui table segment">
  <tr>
    <th>Deck's Name</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($decks as $deck): ?>

        <tr>
            <td><?php echo $deck->name ?></td>
            <td><a class="ui blue icon button" href="<?php echo $edit_deck_url ?>&id=<?php echo $deck->id ?>" style="padding: 7px">Edit</a></td>
            <td>
                <form method="post" action="admin-post.php" id="delete_deck_form<?php echo $deck->id ?>">
                    <!-- pano processing hook -->
                    <input type="hidden" name="action" value="delete_deck" />
                    <input type="hidden" name="deck_id" value="<?php echo $deck->id ?>" />

                    <input type="submit" class="ui blue icon button" value="Delete" style="padding: 7px" >
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
<a class="ui blue icon button" href="<?php echo $new_deck_url ?>" style="padding: 7px">New Domain</a>
</div>

<?php }