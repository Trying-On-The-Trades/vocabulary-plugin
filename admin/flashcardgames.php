<?php

// Build the settings page
function flashcardgame_settings_page() {
    $games = get_decks("flashcard");

    $semantic      = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $new_game_url  = admin_url() . "admin.php?page=new_flashcardgame_settings";
    $edit_game_url = admin_url() . "admin.php?page=edit_flashcardgame_settings&action=edit";
    $hotspot_editor_url = admin_url() . "admin.php?page=new_hotspot_editor_settings";

    $pano_editor = admin_url() . "admin.php?page=view_panos_settings";
    $copy_game_url = admin_url() . "admin.php?page=edit_flashcardgame_settings&action=copy";
    $view_game_url = admin_url() . "admin.php?page=view_flashcardgame_settings";
    ?>

    <!-- style sheet so our admin page looks nice -->
    <link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
    <link rel="stylesheet" type="text/css" href="../flashcard/js/featherlight/featherlight.min.css"/>
    <script type="text/javascript" src="../flashcard/js/featherlight/featherlight.min.js"></script>
    <script type="text/javascript" src="../flashcard/js/featherlight/featherlight-functions.js"></script>
    <hr>

    <?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Settings updated successfully.</p></div>
    <?php endif ?>

    <h2>Flash Card Decks</h2>
    <table id="gameTable" class="ui table segment tablesorter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Number of Words</th>
            <th>Edit</th>
            <th>Copy</th>
            <th>Delete</th>
            <th>View</th>
            <th>Create Hotspot</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($games as $game): ?>
            <?php $current_game = build_deck($game->id); ?>
            <tr>
                <td><?php echo $current_game->get_name(); ?></td>
                <td><?php echo $current_game->get_number_of_words(); ?></td>

                <td><a class="ui blue icon button" href="<?php echo $edit_game_url ?>&id=<?php echo $current_game->get_id() ?>" style="padding: 7px">Edit</a></td>
                <td><a class="ui blue icon button" href="<?php echo $copy_game_url ?>&id=<?php echo $current_game->get_id() ?>" style="padding: 7px">Copy</a></td>
                <td>
                    <form method="post" action="admin-post.php" id="delete_word_form<?php echo $current_game->get_id() ?>">
                        <!-- word processing hook -->
                        <input type="hidden" name="action" value="delete_deck" />
                        <input type="hidden" name="game_type" value="flashcardgame">
                        <input type="hidden" name="game_id" value="<?php echo $current_game->get_id() ?>" />

                        <input type="submit" class="ui blue icon button" value="Delete" style="padding: 7px" >
                    </form>
                </td>
                <td>
                    <form method="POST" action="<?=$view_game_url?>&">
                        <!-- word processing hook -->
                        <input type="hidden" name="deck_id" value="<?php echo $game->id ?>" />

                        <input type="submit" class="ui blue icon button" value="View" style="padding: 7px" >
                    </form>
                </td>
                <td>
                    <form method="POST" action="<?=$pano_editor?>&">
                        <!-- word processing hook -->
                        <input type="hidden" name="game_id" value="<?php echo $game->id ?>" />
                        <input type="submit" class="ui blue icon button" value="Create_Hotspot" style="padding: 7px" >
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a class="ui blue icon button" href="<?php echo $new_game_url ?>" style="padding: 7px">New Deck</a>

    <script>
        jQuery(document).ready(function(){
            jQuery("#gameTable").tablesorter();
        })
    </script>

<?php }
