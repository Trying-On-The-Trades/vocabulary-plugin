<?php

function hatplehgame_settings_page() {
    $games = get_hatgame_deck();

    $semantic         = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $new_game_url  = admin_url() . "admin.php?page=new_hatplehgame_settings";
    $edit_game_url = admin_url() . "admin.php?page=edit_hatplehgame_settings";
    ?>

    <!-- style sheet so our admin page looks nice -->
    <link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
    <hr>

    <?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Settings updated successfully.</p></div>
    <?php endif ?>

    <h2>Games</h2>
    <table id="gameTable" class="ui table segment tablesorter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($games as $game): ?>
            <?php $current_game = build_deck($game->id); ?>
            <tr>
                <td><?php echo $current_game->get_name(); ?></td>
                <td><?php echo $current_game->get_image(); ?></td>

                <td><a class="ui blue icon button" href="<?php echo $edit_game_url ?>&id=<?php echo $current_game->get_id() ?>" style="padding: 7px">Edit</a></td>
                <td>
                    <form method="post" action="admin-post.php" id="delete_word_form<?php echo $current_game->get_id() ?>">
                        <!-- word processing hook -->
                        <input type="hidden" name="action" value="delete_deck" />
                        <input type="hidden" name="game_id" value="<?php echo $current_game->get_id() ?>" />
                        <input type="hidden" name="game_type" value="hatplehgame">
                        <input type="submit" class="ui blue icon button" value="Delete" style="padding: 7px" >
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
    <a class="ui blue icon button" href="<?php echo $new_game_url ?>" style="padding: 7px">New Game</a>

    <script>
        jQuery(document).ready(function(){
            jQuery("#gameTable").tablesorter();
        })
    </script>

<?php }