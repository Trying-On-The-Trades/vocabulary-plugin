var number_of_words_to_guess = 0;

function initiate(type){
    game = [];
    game = run_game(words, type, number_of_words_to_guess_from_db);

    words_to_guess = game[0];
    wrong_words = game[1];

    // How many points the game is worth
    for(var i= 0; i < words_to_guess.length; i++){
        total_game_points = total_game_points + Number(words_to_guess[i]['points']);
    }

    build_word_container(words_to_guess[current_index], type, wrong_words, game_title);

    disable_button("prev");
}

function run_game(words, type, number_of_words_to_guess_from_db){
    var words_to_guess     = [];
    var wrong_words = [], not_pick_again = [],  already_guessed = [];
    var x = 0,  y = 0;
    var picking_new_word = true;

    if(type == "learning"){
        number_of_words_to_guess = words.length;
    }else{
        number_of_words_to_guess = number_of_words_to_guess_from_db;
    }

    // Picking different words
    for(var i = 0; i < number_of_words_to_guess; i++){
        not_pick_again = [];
        picking_new_word = true;

        // Loop until find a word that wasn't picked yet
        while(picking_new_word){
            // Get a random number
            x = get_random_number(words.length);

            // Check if was not picked already
            if(still_not_picked(x, already_guessed)){
                picking_new_word = false;
                already_guessed.push(x);
            }
        }

        // Add to word to be guessed
        words_to_guess.push(words[x]);

        // Can't get the same word again
        not_pick_again.push(x);

        for(var j = 0; j < 3; j++){
            picking_new_word = true;

            while(picking_new_word) {
                // Get a random number
                y = get_random_number(words.length);

                // Check if was not picked already
                if (still_not_picked(y, not_pick_again)) {
                    picking_new_word = false;
                    not_pick_again.push(y);
                    wrong_words.push(words[y]["word"]);
                }
            }

        }
    }

    return [words_to_guess, wrong_words];
}

function get_random_number(max){
    return Math.floor((Math.random() * max));
}

function still_not_picked(number, not_pick_again){
   for(var i = 0; i < not_pick_again.length; i++){
     if(number == not_pick_again[i]){
         return false;
     }
   }
    return true;
}

function build_word_container(word, type, wrong_words, game_title){
    var options_ids = [];
    var right_answer = "";

    if(type == "learning"){
        var html = learning_container(word, game_title);
    }else{
        var game_container_restult = game_container(word, wrong_words, game_title);
        var html           = game_container_restult[0];
        options_ids        = game_container_restult[1];
        right_answer       = game_container_restult[2];
    }

    $("#wrapper").html(html);

    update_lives();

    // Event click passing the size of the array to be showed
    $('#next').click(function(){
        next_word(words_to_guess.length, type, game_title);
    });

    $('#prev').click(function(){
        prev_word(words_to_guess.length, type, game_title);
    });

    $('#check').click(function(e){
        ckeck_answer(options_ids, e, right_answer, word['points']);
    });

    $('input[name = "options"]').change(function(){
       hide_error();
    });

    hide_error();

    if(type == "game"){
        disable_button('next');
    }

    $("#card").flip();
}

function build_lives(){
    var lives = "";
    switch (errors){
        case 0:
            lives = "<span class='live' id='life1'></span>\n" +
                    "<span class='live' id='life2'></span>\n" +
                    "<span class='live' id='life3'></span>\n";
            break;
        case 1:
            lives = "<span class='live dead' id='life1'></span>\n" +
                    "<span class='live' id='life2'></span>\n" +
                    "<span class='live' id='life3'></span>\n";
            break;
        case 2:
            lives = "<span class='live dead' id='life1'></span>\n" +
                    "<span class='live dead' id='life2'></span>\n" +
                    "<span class='live' id='life3'></span>\n";
            break;
        case 3:
            lives = "<span class='live dead' id='life1'></span>\n" +
                    "<span class='live dead' id='life2'></span>\n" +
                    "<span class='live dead' id='life3'></span>\n";
            break;
    }

    return lives;
}

function game_container(word, wrong_words, game_title){
    var inputs = "";
    var lives = "";
    var options_ids = [];
    var right_answer = word['word'];

    // Get a random index for the right answer
    var right_answer_id = get_random_number(3);

    for(var i = 0; i < 4; i++){
        if(i == right_answer_id){
            inputs += ('<input type="radio" ' +
                        'class="" id="' + word['word'] + '" ' +
                        'name="options" ' +
                        'value="' + word['word'] + '">\n' +
                        '<label for="' + word['word'] + '">' + word['word'] + '</label>');

            options_ids.push(word['word']);
        }else{
            inputs += ('<input type="radio" ' +
                        'class="" id="' + wrong_words[0] + '" ' +
                        'name="options" ' +
                        'value="' + wrong_words[0] + '">\n' +
                        '<label for="' + wrong_words[0] + '">' + wrong_words[0] + '</label>');

            options_ids.push(wrong_words[0]);
            wrong_words.splice(0, 1);
        }
    }

    lives = build_lives();

    var html =  "<header id='title'>\n" +
                    "<h1>" + game_title + "</h1>\n" +
                "</header>\n" +
                "<section id='content'>\n" +
                    "<button class='prev disable' id='prev'></button>\n" +
                    "<article id='article' class='game_card'>\n" +
                        "<div id='top_content'>\n" +
                        '<p id="points_result" class="points">' + points + ' pts</p>' +
                            lives +
                        "</div>\n" +
                        "<p class='question'>" + word['description'] + "</p>\n" +
                        "<form name='form_word' id='form_word'>\n" +
                            inputs +
                            "<div class='error' id='error'>You need to select one option</div>\n" +
                            "<button id='check' class='check'>Check Answer</button>\n" +
                            '<input type="text" id="points" value="0" hidden>' +
                        "</form>\n" +
                    "</article>\n" +
                    "<button class='next' id='next'></button>\n" +
                "</section>\n";

    return [html, options_ids, right_answer];

}

function learning_container(word, game_title){

    var image      = word['image'];
    var audio      = word['audio'];
    var audio_tag  = "";
    var image_tag  = "";
    var word_class = "";

    if(image == "" || image == null || image == "../../../"){
        image_tag  = "";
        word_class = "word only_word";
    }else{
        image_tag = "<img src='../wp-content/" + image + "' alt='" + word['word'] + "'>\n";
        word_class = "word";
    }

    if(audio == "" || audio == null){
        audio_tag = "";
    }else{
        audio_tag = "<audio src='../wp-content/" + word['audio'] + "' id='audio' type='audio/mpeg' controls> </audio>\n";
    }


    return "<header id='title'>\n" +
            "<h1>" + game_title + "</h1>\n" +
            "</header>\n" +

            "<section id='content'>\n" +

            "<button class='prev disable' id='prev'></button>\n" +

            "<article id='article'>\n" +

            "<div id='card'>\n" +

            "<div class='front'>\n" +
            "<p class='" + word_class + "'>" + word['word'] + "</p>\n" +
            "<aside id='image'>\n" +
            image_tag +
            "</aside>\n" +
            audio_tag +
            "<footer class='footer'>\n" +
            "<span>Click the card to get description</span>\n" +
            "</footer>\n" +
            "</div>" +

            "<div class='back'>\n" +
            "<p class='description'>" + word['description']+"</p>\n" +
            "<footer class='footer'>\n" +
            "<span>Click the card to get word</span>\n" +
            "</footer>\n" +
            "</div>\n" +
            "</div>\n" +

            "</article>\n" +
            "<button class='next' id='next'></button>\n" +
            '<input type="text" id="points" value="0" hidden>' +
            "</section>\n";
}

function next_word(words_length, type, game_title){

    current_index = current_index + 1;

    if(type == "learning" && current_index < words_length){
        build_word_container(words_to_guess[current_index], "learning", wrong_words, game_title);
    }else if(type == "game" && current_index < words_length){
        build_word_container(words_to_guess[current_index], "game", wrong_words, game_title);
    }else{
        build_learn_container(game_title);
    }

    if(current_index >= (words_length)){
        disable_button("next");
    }

    if(current_index > 0 && type == "learning"){
        enable_button('prev');
    }
}

function prev_word(words_length, type, game_title){

    current_index = current_index - 1;

    if(type == "learning"){
        build_word_container(words_to_guess[current_index], "learning", wrong_words, game_title);
    }else{
        build_word_container(words_to_guess[current_index], "game", wrong_words, game_title);
    }

    if(current_index == 0){
        disable_button("prev");
    }

    if(current_index < (words_length - 1)){
        enable_button('next');
    }

    if(current_index > 0 && type == "learning"){
        enable_button('prev');
    }

}

function disable_button(button_id){
    $('#'+button_id).prop("disabled", true);
    $('#'+button_id).addClass('disable');
}

function enable_button(button_id){
    $('#'+button_id).prop("disabled", false);
    $('#'+button_id).removeClass('disable');
}

function update_lives(){
    switch (errors){
        case 0:
            $('#life1').removeClass("dead");
            $('#life2').removeClass("dead");
            $('#life3').removeClass("dead");
            break;
        case 1:
            $('#life1').addClass("dead");
            break;
        case 2:
            $('#life2').addClass("dead");
            break;
        case 3:
            $('#life3').addClass("dead");
            build_game_over();
            break;
    }
}

function block_panel(){
    $('input[name = "options"]').attr('disabled', true);
    $('#check').addClass('disable');

    disable_button('check');
}

function add_points(word_points){
    points = points + Number(word_points);
    $('#points').val(points);
    $('#points_result').html(points + ' pts');

}

function ckeck_answer(options_ids, event, right_answer, word_points){
    if(user_checked_one_answer(options_ids)){
        var option_selected = $('input[name = "options"]:checked', '#form_word').val();

        if(option_selected == right_answer){
            event.preventDefault();
            var label_name = 'label[for="' + option_selected + '"]';
            $(label_name).addClass('correct');

            add_points(word_points);
        }else{
            event.preventDefault();

            var label_name = 'label[for="' + option_selected + '"]';
            $(label_name).addClass('incorrect');

            label_name = 'label[for="' + right_answer + '"]';
            $(label_name).addClass('correct');

            errors = errors + 1;

            update_lives();
        }

        block_panel();

        if(!(current_index >= (words_to_guess.length - 1))){
            enable_button('next');
        }else{
            build_game_over();
        }

    }else{
       event.preventDefault();
       show_error();
    }
}

function user_checked_one_answer(options_ids){
    var is_checked = false;
    var radio_element;

    for(var i = 0; i < options_ids.length; i++){
        radio_element = document.getElementById(options_ids[i]);

        if(radio_element.checked){
            is_checked = true;
        }
    }

    return is_checked;
}

function hide_error(){
    $('#error').css( "display", "none");
}

function show_error(){
    $('#error').css( "display", "block");
}

function build_home(){
    var html = home_container(game_title);

    $("#wrapper").html(html);

    $("#game").click(function(){
        initiate("game");
    });

    $("#learning").click(function(){
        initiate("learning");
    });
}

function build_game_over(){
    errors = 0;
    current_index = 0;
    words_to_guess;
    wrong_words;
    game = [];


    var final_message = final_message_game();
    var html = game_over_container(final_message, game_title);

    points = 0;
    total_game_points = 0;

    $("#wrapper").html(html);

    $("#game").click(function(){
        initiate("game");
    });

    $("#learning").click(function(){
        initiate("learning");
    });

    draw_graph();
}

function final_message_game(){
    var message = "";

    switch (true){
        case (points == total_game_points):
            message = "You have got full marks! :)";
            break;
        case ((total_game_points / 2) > points):
            message = "You got less than 50%. You should try again! ;)"
            break;
        default:
            message = "Well played! You should try again for full marks! ;)"
            break;
    }

    return message;
}

function game_over_container(final_message, game_title){
    var points_percentage = (points * 100) / total_game_points;
    var game_over_title = "GAME OVER!!";

    if(final_message == "You have got full marks! :)"){
        game_over_title = "Congratulations!!";
    }

    return  "<header id='title'>\n" +
            "<h1>" + game_title + "</h1>\n" +
            "</header>\n" +
            "<section id='content' class='game_over'>\n" +
            '<h2 id="game_result">' + game_over_title + '</h2>' +
            '<p>Points earned:</p>' +
            '<div id="myStat1" class:"graph" data-dimension="200" data-text="' + points + ' / ' + total_game_points + '" data-width="8" data-percent="' + points_percentage + '" data-fgcolor="#0192E1" data-bgcolor="#ccc"></div>' +
            '<span id="game_result_message">' + final_message + '</span>' +
            "<button id='learning' class='over_learning'>Back to Learning</button>\n" +
            "<button id='game' class='over_game'>Play Again!</button>\n" +
            '<input type="text" id="points" value="0" hidden>' +
            "</section>\n";

}

function draw_graph(){
    $( document ).ready(function() {
        $('#myStat1').circliful();
    });
}

function home_container(game_title){
    return  "<header id='title'>\n" +
                "<h1>" + game_title + "</h1>\n" +
            "</header>\n" +
            "<section id='content' class='start'>\n" +
                "<button id='learning' class='learning'>Learning Section</button>\n" +
                "<button id='game' class='game'>Play Game!</button>\n" +
                '<input type="text" id="points" value="0" hidden>' +
            "</section>\n";
}

function final_learn_container(game_title){
    return  "<header id='title'>\n" +
            "<h1>" + game_title + "</h1>\n" +
            "</header>\n" +
            "<section id='content' class='game_over'>\n" +
            '<h2>DONE!!!</h2>' +
            '<p>You just finished the learning section!!</p>' +
            '<p>What do you want to do next ?</p>' +
            "<button id='learning' class='over_learning'>Do it again!</button>\n" +
            "<button id='game' class='over_game'>Play Game!</button>\n" +
            '<input type="text" id="points" value="0" hidden>' +
            "</section>\n";
}

function build_learn_container(game_title) {

    errors = 0;
    points = 0;
    total_game_points = 0;
    current_index = 0;
    words_to_guess;
    wrong_words;
    game = [];

    var html = final_learn_container(game_title);

    $("#wrapper").html(html);

    $("#game").click(function(){
        initiate("game");
    });

    $("#learning").click(function(){
        initiate("learning");
    });
}