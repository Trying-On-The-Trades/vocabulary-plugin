<?php

    function hatgame_view_page() {

    $word = "";
    $hint = "";
    $profession = "";
    if(isset($_GET['deck'])) {

        $deck_id = $_GET['deck'];
        if (is_numeric($deck_id)) {
            $words = get_hatpleh_words($deck_id);
            $term = $words[mt_rand(0, count($words) - 1)];
            $word = $term['word'];
            $hint = $term['description'];
            $profession = $term['name'];
            $winner = $term['image'];
            $points = intval($term['points']) / 10;
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript">
            var word = "<?= $word ?>";
            var hint = "<?= $hint ?>";
            var winner_image = "<?= $winner ?>";
            var points_value = <?= $points ?>;
        </script>
        <script src="hatpla.js"></script>
        <link rel="stylesheet" href="style-2.css">
        <title>Hat Pla</title>
    </head>
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

</html>
<?php }