<?php
    
    require('db.php');
    //$var = [];
    $word = "";
    $hint = "";
    $winner = "";
    $points = 0;
    $image_url = '../../../';


    // $style_css = WP_PLUGIN_URL . '/vocabulary-plugin/hatpleh/css/style-2.css';
    // $main_js = WP_PLUGIN_URL . '/vocabulary-plugin/hatpleh/js/hatpla.js';
    // $jquery_css = WP_PLUGIN_URL . '/vocabulary-plugin/hatpleh/css/jquery-ui.css';
    // $jquery_js = WP_PLUGIN_URL . '/vocabulary-plugin/hatpleh/js/jquery.easy-confirm-dialog.js';

    if (isset($_GET['deck'])) {
        $deck = intval($_GET['deck']);
        $db = database_connection();
        $words = get_hatpleh_words($db, $deck);
        $term = $words[mt_rand(0, count($words) - 1)];
        $word = $term['word'];
        $hint = $term['description'];
        $profession = $term['name'];
        $winner = $term['image'];
        $points = intval($term['points']) / 10;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>HatPleh!</title>
    <meta charset="UTF-8">
    <script type="text/javascript">
        var word = "<?= $word ?>";
        var hint = "<?= $hint ?>";

        var winner_image = "<?= $image_url . $winner ?>";

        var points_value = <?= $points ?>;
    </script>
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/hatpla_hotspot.js"></script>
    <script type="text/javascript" src="js/jquery.easy-confirm-dialog.js"></script>
    <link href="css/style-3.css" type="text/css" rel="stylesheet">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    
</head>
<body>
<div id="wrapper">
    <h2>Can you earn your <?= $profession ?>'s Hat?</h2>
    <div class="content">
        <aside><p id="life"></p></aside>
    </div>
    <div class="content">
        <aside><p id="points"><?=get_points_symbol($db)?> <span id="points_so_far"></span></p></aside>
        <div id="buttons"></div>
        <div id="inf">
            <div id="smileImage"></div>
            <p id="categoryName"></p>
            <div id="hold"></div>
            <p id="gameOver"></p>
            <p id="clue"></p>
        </div>
    </div>
</div>
<div class="container">
    <button id="hint">Hint</button>
    <button id="reset">Play again</button>
    <input id="points" type="hidden" value="0"/>
</div>
<script>
    $("#hint").easyconfirm({locale: { text: 'Are you sure you want to use hint? You will lose 2 points!', button: ['No','Yes']}});
</script>
</body>
</html>