<?php

    function view_hatplehgame_settings_page()
    {

        $style_css = WP_PLUGIN_URL . '/vocabulary-plugin/hatpleh/css/style-2.css';
        $main_js = WP_PLUGIN_URL . '/vocabulary-plugin/hatpleh/js/hatpla.js';

        if (isset($_POST['deck_id'])) {
            $deck = intval($_POST['deck_id']);
            $words = get_all_game_words($deck);
            $term = $words[mt_rand(0, count($words) - 1)];
            $word = $term['word'];
            $hint = $term['description'];
            $profession = $term['name'];
            $winner = $term['image'];
            $points = intval($term['points']) / 10;
        }
        ?>

<script type="text/javascript">
    var word = "<?= $word ?>";
    var hint = "<?= $hint ?>";
    var winner_image = "<?= $winner ?>";
    var points_value = <?= $points ?>;
</script>
<script type="text/javascript" src="<?=$main_js?>"></script>
<link href="<?=$style_css?>" type="text/css" rel="stylesheet">

<div class="wrapper">
    <h2>Can you earn your <?= $profession ?>'s Hat?</h2>
</div>
<div class="content">
    <div id="buttons">
    </div>
    <div id="inf">
        <p id="categoryName"></p>
        <div id="hold">
        </div>
        <p id="mylives"></p>
        <div id="smileImage">
        </div>
        <p id="clue"></p>
    </div>

</div>
    <div class="container">
      <button id="hint">Hint</button>
      <button id="reset">Play again</button>
      <input id="points" type="hidden" value="0"/>
    </div>

<?php }