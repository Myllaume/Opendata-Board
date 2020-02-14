<?php
function JSON_file_to_array($JSON_file_path) {
    $json_file = file_get_contents($JSON_file_path);
    $json_file = json_decode($json_file, true);
    return $json_file;
}

function find_all_keys($total_JSON_array, $key) {
    $tab = [];

    foreach ($total_JSON_array as $tab_index => $value) {
        array_push($tab, $value[$key]);
    }

    $tab = array_unique($tab);

    return $tab;
}