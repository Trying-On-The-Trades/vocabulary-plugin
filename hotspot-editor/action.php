<?php

    $mission      = $_POST['mission_id'];
    $domain       = $_POST['hotspot_domain_id'];
    $description  = $_POST['hotspot_description'];
    $point_x      = $_POST['point_x'];
    $point_y      = $_POST['point_y'];
    $hotspot_icon = $_POST['hotspot_icon'];
    $deck_id      = $_POST['deck_id'];
    $game_type    = $_POST['game_type'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">

        var url          = "'" + document.location.origin + "/wordpress/wp-admin/admin-post.php" + "'";
        var mission      = '';
        var domain       = '';
        var description  = '';
        var point_x      = '';
        var point_y      = '';
        var hotspot_icon = '';
        var deck_id      = '';
        var game_type    = '';

        mission      = <?=$mission?>;
        domain       = '<?=$domain?>';
        description  = '<?=$description?>';
        point_x      = <?=$point_x?>;
        point_y      = <?=$point_y?>;
        hotspot_icon = '<?=$hotspot_icon?>';
        deck_id      = <?=$deck_id?>;
        game_type    = '<?=$game_type?>';

        var icon = false;

        if('<?=$hotspot_icon?>'){
            icon = true;
        }

        function add_new_hotspot(domain_id, mission_id, hotspot_description, hotspot_icon, x, y, deck_id, game_type) {

            $.ajax({
                type: 'POST',
                url: 'http://localhost:8888/wordpress/wp-admin/admin-post.php',
                data: {
                    action: 'create_new_hotspot_ajax',
                    mission_id: mission_id,
                    domain_id: domain_id,
                    hotspot_description: hotspot_description,
                    hotspot_icon: hotspot_icon,
                    hotspot_x: x,
                    hotspot_y: y,
                    deck_id: deck_id,
                    game_type: game_type
                },
                success: function (d) {
                    //alert('Hotspot Added!' + d);
                    window.location.href = 'http://localhost:8888/wordpress/pano/';
                },
                error: function (d) {
                    alert('Hotspot Fail!');
                }
            });

            //console.log(id);

        }

        add_new_hotspot(domain, mission, description, icon, point_x, point_y, deck_id, game_type);

    </script>
</head>
</html>