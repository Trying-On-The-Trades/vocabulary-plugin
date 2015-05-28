<?php
function pano_category_settings_page() {
    $categories = get_categorys();

    $semantic       = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
    $new_category_url  = admin_url() . "admin.php?page=new_category_settings";
    $edit_category_url = admin_url() . "admin.php?page=edit_category_settings";
    ?>

<!-- style sheet so our admin page looks nice -->
<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>
<p>Manage your categories!</p>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
        <div class="updated"><p>Settings updated successfully.</p></div>
    <?php endif ?>

<h2>Categories</h2>
<table class="ui table segment">
  <tr>
    <th>Category</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($categories as $category): ?>

        <tr>
            <td><?php echo $category->name ?></td>
            <td><a class="ui blue icon button" href="<?php echo $edit_category_url ?>&id=<?php echo $category->id ?>" style="padding: 7px">Edit</a></td>
            <td>
                <form method="post" action="admin-post.php" id="delete_category_form<?php echo $category->id ?>">
                    <!-- pano processing hook -->
                    <input type="hidden" name="action" value="delete_category" />
                    <input type="hidden" name="category_id" value="<?php echo $category->id ?>" />

                    <input type="submit" class="ui blue icon button" value="Delete" style="padding: 7px" >
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
<a class="ui blue icon button" href="<?php echo $new_category_url ?>" style="padding: 7px">New category</a>
</div>

<?php }