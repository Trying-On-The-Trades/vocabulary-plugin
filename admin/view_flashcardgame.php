<?php

function view_flashcardgame_settings_page() {

    $main_js       = WP_PLUGIN_URL . '/vocabulary-plugin/flashcard/js/main.js';
    $flip_js       = WP_PLUGIN_URL . '/vocabulary-plugin/flashcard/js/jquery.flip.js';
    $circliful_js  = WP_PLUGIN_URL . '/vocabulary-plugin/flashcard/js/jquery.circliful.min.js';
    $circliful_css = WP_PLUGIN_URL . '/vocabulary-plugin/flashcard/css/jquery.circliful.css';
    $style_css     = WP_PLUGIN_URL . '/vocabulary-plugin/flashcard/css/style.css';

    if (isset($_POST['deck_id'])) {
        $deck            = intval($_POST['deck_id']);
        $words           = get_all_game_words($deck);
        $number_of_words = get_number_of_words_for_game($deck);
        $deck_name       = get_deck_title($deck);
        $currency        = get_points_symbol();
    }

?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?=$flip_js?>"></script>
        <script src="<?=$main_js?>"></script>
        <link href="<?=$circliful_css?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?=$circliful_js?>"></script>
        <link href="<?=$style_css?>" type="text/css" rel="stylesheet">

        <script type="text/javascript">
            var game_title = "<?php echo $deck_name->name ?>";
            var currency   = "<?php echo $currency?> ";
        </script>

        <div id="wrapper">
            <script type="text/javascript">

                var words = [
                <?php foreach($words as $word): ?>
                    {word:"<?php echo $word->word?>", description:"<?php echo $word->description?>", image:"<?php echo $word->image?>", audio:"<?php echo $word->audio?>", points:"<?php echo $word->points?>"},
                <?php endforeach; ?>

                ];

                var number_of_words_to_guess_from_db = Number("<?php echo $number_of_words->number_of_words?>");

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
<?php }