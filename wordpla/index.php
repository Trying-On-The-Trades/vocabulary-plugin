<?php

    if (isset($_GET['id']) && is_numeric( $_GET['id']) ) {
        $game = build_deck($_GET['id']);
        $words = get_all_game_words($_GET['id']);
    }else{
        $words = get_all_game_words(1);
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
        <div id="wrapper">
            <script type="text/javascript">

                var words = [
                <?php foreach($words as $word): ?>
                    {word:"<?php echo $word->word?>", description:"<?php echo $word->description?>", image:"<?php echo $word->image?>", audio:"<?php echo $word->audio?>", points:"<?php echo $word->points?>"},
                <?php endforeach; ?>

                ];

//                var words = [ {word:"Mjolnir", description:"Is a fictional weapon appearing in American comic books published by Marvel Comics and is the favored weapon of the superhero Thor.", image:"mjolnir.jpg", audio:"mjolnir.mp3", points:"40"},
//                    {word:"Tesseract", description:"Is a cube-shaped containment vessel for an Infinity Stone possessing unlimited energy. It contained one of six singularities that predated the universe. Once the universe came into existence, it changed form.", image:"tesseract.png", audio:"tesseract.mp3", points:"20"},
//                    {word:"Infinity Gauntlet", description:"Was designed to hold six of the 'soul gems', better known as the Infinity Gems. When used in combination their already impressive powers make the wearer able to do anything he/she wants.", image:"gauntlet.jpg", audio:"gauntlet.mp3", points:"50"},
//                    {word:"Captain America\'s Shield", description:"Is a disc shaped object with a five-pointed star design in its center, within blue, red, and white concentric circles. This shield is composed of a unique alloy of Vibranium, steel, and an unknown third component. It is virtually indestructible.", image:"capShield.jpg", audio:"capShield.mp3", points:"20"},
//                    {word:"Stormbreaker", description:"Made as a sort of duplicate version of the enchanted hammer Mjolnir.", image:"stormbreaker.jpg", audio:"stormbreaker.mp3", points:"70"},
//                    {word:"Daredevil\'s billy clubs", description:"It's initial form is held together by an extendable cable. It can shift from a nunchaku- like weapon to a manrikigusari, which can be wielded in an Eskrima-like fashion, staff, or a cable with a grappling hook. The weapon can also be adjusted to combine both sticks into an Eskrima stick.", image:"billyClubs.jpg", audio:"billyClubs.mp3", points:"10"},
//                    {word:"Mandarin\'s Rings", description:"Are Makluan artifacts which contain the souls of long-dead cosmic warriors trapped in a phantasmal state.", image:"mandarinRings.jpg", audio:"mandarinRings.mp3", points:"30"},
//                    {word:"Ultimate Nullifier", description:"The greatest weapon in the Marvel universe, can destroy anything.Anything. It can destroy timelines, it can destroy an entire multiverse.", image:"ultimateNullifier.jpg", audio:"ultimateNullifier.mp3", points:"10"},
//                    {word:"Chitauri Scepter", description:"Is served as containment device for one of the Infinity Stones. It was wielded by Loki in theinvasion of Earth, who received it as a gift from Thanos.", image:"chitauriScepter.jpg", audio:"chitauriScepter.mp3", points:"60"},
//                    {word:"Black Widow\'s Bite", description:"Is an electroshock weapon, created by S.H.I.E.L.D.'s Tech Directorate, that can deliver powerful electrical discharges from two shaped bracelets.", image:"widowsBite.png", audio:"widowsBite.mp3", points:"10"},
//                    {word:"Infinity Stones", description:"Are six immensely powerful objects tied to different aspects of the universe, created by the Cosmic Entities. Each of these objects possesses unique capabilities that have been enhanced and altered by various alien civilizations through the millennia.", image:"infinityStones.jpg", audio:"InfinityStones.mp3", points:"50"},
//                    {word:"Default", description:"This is an example using a default image.", image:"questionMark.png", audio:"", points:"10"}
//                ];

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
