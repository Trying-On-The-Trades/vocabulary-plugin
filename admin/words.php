<?php

// Build the settings page
function word_settings_page() {
    $words         = get_words();
    $categories    = get_word_categories();
    $domains       = get_domains();
    $semantic      = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
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

    <h2>Word List</h2>

    <div class="ui form">
        <div class="field">
            <label for="filter">Filter the words by</label>
            <select name="domain_id" id="domain_id">
                <option value="NA">Select a Domain</option>
                <?php foreach($domains as $domain): ?>
                    <option value="<?php echo $domain->id ?>"><?php echo $domain->name ?></option>
                <?php endforeach; ?>
            </select>
            <select name="category_id" id="category_id">
                <option value="NA">Select a Category</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <table id="wordTable" class="ui table segment tablesorter">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Points</th>
            <th>Image</th>
            <th>Audio</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($words as $word): ?>
            <?php $current_word = build_words($word->id); ?>
            <tr>
                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>"><?php echo $current_word->get_word(); ?></td>
                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>"><?php echo $current_word->get_description(); ?></td>
                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>"><?php echo $current_word->get_points(); ?></td>
                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>"><?php echo $current_word->get_image(); ?></td>
                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>"><?php echo $current_word->get_audio(); ?></td>

                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>"><a class="ui blue icon button" href="<?php echo $edit_word_url ?>&id=<?php echo $current_word->get_id(); ?>" style="padding: 7px">Edit</a></td>
                <td class="dom_option cat_option dom<?php echo $word->domain_id ?> cat<?php echo $word->word_category_id ?>">
                    <form method="post" action="admin-post.php" id="delete_word_form<?php echo $current_word->get_id(); ?>">
                        <!-- word processing hook -->
                        <input type="hidden" name="action" value="delete_word" />
                        <input type="hidden" name="word_id" value="<?php echo $current_word->get_id(); ?>" />

                        <input type="submit" class="ui blue icon button" value="Delete" style="padding: 7px" >
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
    <a class="ui blue icon button" href="<?php echo $new_word_url ?>" style="padding: 7px">New Word</a>

    <script>
        jQuery(document).ready(function(){
            jQuery("#wordTable").tablesorter();
        })

        jQuery("#category_id").change(function(){
            filter_words();
        });

        jQuery("#domain_id").change(function(){
            filter_words();
        });

        function validation()
        {

        }

        function filter_words()
        {
            var cat_selected = jQuery( "#category_id option:selected" ).val();
            var dom_selected = jQuery( "#domain_id option:selected" ).val();

            jQuery(".cat_option").hide();
            //jQuery("input:checkbox").hide();

            if(cat_selected == "NA" && dom_selected == "NA")
            {
                jQuery(".cat_option").show();
            }
            else if(cat_selected != "NA" && dom_selected == "NA")
            {
                jQuery(".cat_option").hide();
                jQuery(".cat" + cat_selected).show();
            }
            else if(cat_selected == "NA" && dom_selected != "NA")
            {
                jQuery(".cat_option").hide();
                jQuery(".dom" + dom_selected).show();
            }
            else
            {
                jQuery(".cat_option").hide();
                jQuery(".dom" + dom_selected + ".cat" + cat_selected).show();
            }
            jQuery("input:checkbox").hide();
        }
    </script>

<?php }
