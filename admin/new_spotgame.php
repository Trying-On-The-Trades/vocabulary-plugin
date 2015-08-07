<?php
// Build the settings page
function new_spotgame_settings_page() {
  $semantic = WP_PLUGIN_URL . '/vocabulary-plugin/css/semantic.css';
  $decks = get_decks('flashcard');
  $deck_words = get_deck_words('');
  $domains   = get_domains();
  $categories = get_word_categories();
  $words = array();
  $deck_id = 'NA';

  if((isset($_POST['decks'])) && is_numeric($_POST['decks'])){
    $deck_id = $_POST['decks'];
    $words = get_deck_words($deck_id);
  } else {
    $words = array();
  }

?>

<link rel="stylesheet" type="text/css" href="<?php echo $semantic ?>"/>

<h2>Create a New Game!</h2>
<hr>

<div class="ui form segment new_word_form">
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
  <input type="hidden" name="action" value="create_new_spotgame" />
  <input type="hidden" name="decks" value="<?= $deck_id ?>" />
    <div class="ui form">
      <div class="field">
        <div class="ui left labeled icon input">
          <label for="game_name">Create a question to display in the game: </label>
          <input name="game_name" id="name" required />
        </div>
      </div>
    </div>
    <p class="error" id="not_enough_words">* Select just one word</p>
    <div class="ui form">
      <div class="field">
        <label>Pick a word:</label>
        <ul>
          <?php foreach($words as $word): ?>
          <li class="games_form">
            <input type="checkbox" id="<?php echo $word->id ?>" class="" name="words[]" value="<?php echo $word->id ?>">
            <label for="<?php echo $word->id ?>" class="" ><?php echo $word->word ?></label>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <?php submit_button(); ?>
  </div>
</form>
<?php endif; ?>

<script>
jQuery(document).ready(function(){
  jQuery("#pano_id").change(function(){
    var quest_id = jQuery("option:selected", this).attr("data-quest-id");
    jQuery("#quest_id").val(quest_id);
  });
});

function addForm() {
  document.getElementById("buttonDomain").style.display = "none";
  document.getElementById("domain_form").style.display = "block";
}

jQuery('#form').submit(function(e){
  user_selected_enough_words(e);
});

jQuery('#game_number_of_words').change(function(){
  document.getElementById("words_error").style.display = "none";
  document.getElementById("not_enough_words").style.display = "none";
});

jQuery("input:checkbox").change(function(){
  document.getElementById("words_error").style.display = "none";
  document.getElementById("not_enough_words").style.display = "none";
});

function user_selected_enough_words(e){
  var n = jQuery("input:checkbox:checked").length;
  var game_number_of_words = jQuery('#game_number_of_words').prop('value');

  if(n > 1 || n < 1){
    e.preventDefault();
    document.getElementById("not_enough_words").style.display = "block";
    document.getElementById("words_error").style.display = "none";
  }
  else if(n < Number(game_number_of_words)){
    e.preventDefault();
    document.getElementById("words_error").style.display = "block";
    document.getElementById("not_enough_words").style.display = "none";
  }else{
    document.getElementById("words_error").style.display = "none";
    document.getElementById("not_enough_words").style.display = "none";
  }
}
</script>

<?php }
