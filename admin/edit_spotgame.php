<?php
// Build the settings page
function edit_spotgame_settings_page() {
  $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
  $game_id = filter_input(INPUT_POST,'id');
  $game    = get_deck($game_id);
  $domains  = get_domains();
  $categories = get_word_categories();
  $words = array();
  $decks = get_decks('flashcard');
  $deck_id = 'NA';

  if((isset($_POST['decks'])) && is_numeric($_POST['decks'])){
    $deck_id = $_POST['decks'];
    $words = get_deck_words($deck_id);
  } else {
    $words = array();
  }

  //Will be empty if it's a copy or
  //Will have the id if it's an update
  $game_id_to_form = "";
  if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
    $game = build_deck($_GET['id']);
    $deck_words = get_number_of_words_for_game($_GET['id']);
  }
  $selected_words_ids = array($deck_words->number_of_words);
?>

<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>

<h2>Edit a Game!</h2>
<hr>

<?php if ( isset( $_GET[ 'settings-saved' ] ) ): ?>
  <div class="updated"><p>Game updated successfully.</p></div>
<?php elseif ( isset( $_GET[ 'error' ] ) ): ?>
  <div class="error"><p>Error updating game.</p></div>
<?php endif; ?>

<div class="ui form segment edit_word_form">
<form method="POST">
  <div class="ui form">
    <div class="field">
      <label>Choose a Deck:</label>
      <select name="decks" id="deck_id">
        <option value="NA">Select a Deck</option>
        <?php foreach($decks as $deck): ?>
        <option value="<?php echo $deck->id ?>" <?= ($deck->id == $deck_id)? 'selected' : '' ?> ><?php echo $deck->name ?></option>
        <?php endforeach; ?>
      </select>
      <input type="submit" value="Choose" class="ui blue icon button" style="padding: 7px;">
    </div>
  </div>
</form>

<?php if($deck_id != 'NA'): ?>
<form id="form" method="post" enctype="multipart/form-data" action="<?php echo get_admin_url() . 'admin-post.php' ?>">
<!-- pano processing hook -->
<input type="hidden" name="action" value="edit_spotgame" />

<?php
if(isset($_GET['action']) && $_GET['action'] == "edit"){
  $game_id_to_form = $game->get_id();
}elseif(isset($_GET['action']) && $_GET['action'] == "copy"){
  $game_id_to_form = "copy";
}
?>

<input type="hidden" name="game_id" value="<?= $game_id_to_form ?>"/>
<input type="hidden" name="decks" value="<?= $deck_id ?>" />
  <div class="ui form">
    <div class="field">
      <div class="ui left labeled icon input">
        <label for="game_name">Question that will display in the game: </label>
        <input name="game_name" id="name" value="<?php echo $game->get_name() ?>" required />
      </div>
    </div>
  </div>
  <p class="error" id="not_enough_words">* Select just one word</p>
  <div class="ui form">
    <div class="field">
      <label>Pick a word:</label>
      <ul>
        <?php foreach($words as $word): ?>
          <?php if(in_array($word->id, $selected_words_ids)): ?>
          <li class="games_form">
            <input type="radio" id="<?php echo $word->id ?>" name="words[]" value="<?php echo $word->id ?>" checked>
            <label for="<?php echo $word->id ?>" ><?php echo $word->word ?></label>
          </li>
          <?php else :?>
          <li class="games_form">
            <input type="radio" id="<?php echo $word->id ?>" name="words[]" value="<?php echo $word->id ?>">
            <label for="<?php echo $word->id ?>" ><?php echo $word->word ?></label>
          </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <?php submit_button(); ?>
</div>
</form>
<?php endif; ?>

<?php }
