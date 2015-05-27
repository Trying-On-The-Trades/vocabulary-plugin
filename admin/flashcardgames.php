<?php

// Build the settings page
function flashcardgame_settings_page() {
    $games = get_decks();

    $semantic         = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $new_game_url            = admin_url() . "admin.php?page=new_flashcardgame_settings";
    $edit_game_url           = admin_url() . "admin.php?page=edit_flashcardgame_settings";
    ?>

    <!-- style sheet so our admin page looks nice -->
    <link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
    <hr>

    <?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Settings updated successfully.</p></div>
    <?php endif ?>

    <h2>Flash Card Games</h2>
    <table id="wordTable" class="ui table segment tablesorter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Num of words to get Randomly</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($games as $game): ?>

            <tr>
                <td><?php echo $game->name ?></td>
                <td><?php echo $game->image ?></td>
                <td><?php echo $game->number_of_words ?></td>

                <td><a class="ui blue icon button" href="<?php echo $edit_game_url ?>&id=<?php echo $game->id ?>" style="padding: 7px">Edit</a></td>
                <td>
                    <form method="post" action="admin-post.php" id="delete_word_form<?php echo $game->id ?>">
                        <!-- word processing hook -->
                        <input type="hidden" name="action" value="delete_word" />
                        <input type="hidden" name="word_id" value="<?php echo $game->id ?>" />

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
            jQuery("#wordTable").tablesorter();
        })
    </script>

<?php }