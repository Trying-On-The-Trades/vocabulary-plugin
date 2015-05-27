<?php
    include '../functions/db_funtions.php';

    echo 'Test';

    $words = get_words();
    echo "words";
    //$game_words = get_all_game_words(1);

    echo $words;
    //echo $game_words;

//    compare_words(); // Return an array with words already on the game
//
//    create_inputs();
?>



<!--<form name="form_word" id="form_word">-->
<!--    <input class="" id="Daredevil's billy clubs" name="options" value="Daredevil's billy clubs" type="radio">-->
<!--    <label for="Daredevil's billy clubs">Daredevil's billy clubs</label><input class="" id="Tesseract" name="options" value="Tesseract" type="radio">-->
<!--    <label for="Tesseract">Tesseract</label><input class="" id="Stormbreaker" name="options" value="Stormbreaker" type="radio">-->
<!--    <label for="Stormbreaker">Stormbreaker</label><input class="" id="Infinity Gauntlet" name="options" value="Infinity Gauntlet" type="radio">-->
<!--    <label for="Infinity Gauntlet">Infinity Gauntlet</label><div style="display: none;" class="error" id="error">You need to select one option</div>-->
<!--    <button id="check" class="check">Check Answer</button>-->
<!--    <input id="points" value="0" hidden="" type="text">-->
<!--</form>-->

