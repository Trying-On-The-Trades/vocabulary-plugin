<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','wordpress');

function database_connection()
{
    return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}


function get_missions($db){

    $pano_text_table_name    = 'wp_pano_text';
    $mission_table_name      = 'wp_pano_mission';
    $mission_text_table_name = 'wp_pano_mission_text';
    $missions = array();

    // DB query
    $rows = $db->query(
        "SELECT wpm.id as mission_id, wpm.quest_id, wpm.points, wpm.mission_xml, wpmt.*, wpt.name as pano_name" .
        "FROM " . $mission_table_name . " wpm " .
        "INNER JOIN " . $mission_text_table_name . " wpmt ON wpmt.mission_id = wpm.id " .
        "INNER JOIN " . $pano_text_table_name . " wpt ON wpt.id = wpm.pano_id " .
        " ORDER BY id ASC");

    while($row = $rows->fetch_object())
    {
        array_push($final, array('id' => $row->mission_id,'quest_id' => $row->quest_id,
            'points' => $row->points, 'mission_xml' => $row->mission_xml, 'name' => $row->pano_name));
    }

    // Return
    return $missions;
}

function get_domains($db){
    $domains = array();
    $domain_table_name = 'wp_pano_domains';

    // Get the schools out of the database
    $rows = $db->query(
        "SELECT * FROM " . $domain_table_name . " wpt ");

    while($row = $rows->fetch_object())
    {
        array_push($final, array('id' => $row->id,'name' => $row->name));
    }

    return $domains;
}

?>