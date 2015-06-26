<?php

    require('db.php');

    if (isset($_GET['id'])) {
        $deck            = intval($_GET['id']);
        $db              = database_connection();
        $words           = get_all_game_words($db, $deck);
        $number_of_words = get_number_of_words_for_game($db, $deck);
        $deck_name       = get_deck_title($db, $deck);
        $image_url = '../../../';
        $currency        = get_points_symbol($db);
    }

?>

<!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.flip.js"></script>
<script src="js/main.js"></script>
<link href="css/jquery.circliful.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.circliful.min.js"></script>
<link href="css/style.css" type="text/css" rel="stylesheet">
<title>Vocabulary Play - Game</title>
</head>

<body>

<script type="text/javascript">
    var game_title = "<?php echo $deck_name ?>";
    var currency   = "<?php echo $currency ?>";
</script>

<div id="wrapper">
    <script type="text/javascript">

        var words = [
            <?php foreach($words as $word): ?>
            {word:"<?php echo $word['word']?>", description:"<?php echo $word['description']?>", image:"<?php echo $image_url . $word['image']?>", audio:"<?php echo $word['audio']?>", points:"<?php echo $word['points']?>"},
            <?php endforeach; ?>

        ];

        var number_of_words_to_guess_from_db = Number("<?php echo $number_of_words?>");

        var errors = 0;
        var points = 0;
        var total_game_points = 0;
        var current_index = 0;
        var words_to_guess;
        var wrong_words;
        var game = [];

        build_home();

    </script>

</div>

</body>
</html>
