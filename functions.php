<?php
function JSON_file_to_array($JSON_file_path) {
    $json_file = file_get_contents($JSON_file_path);
    $json_file = json_decode($json_file, true);
    return $json_file;
}

function CSV_file_to_array($CSV_file_path) {
    $csv_file = file_get_contents($CSV_file_path);
    $csv_file = str_getcsv($csv_file, ",");
    return $csv_file;
}

function find_all_keys($total_JSON_array, $key) {
    $tab = [];

    foreach ($total_JSON_array as $tab_index => $value) {
        array_push($tab, $value[$key]);
    }

    $tab = array_unique($tab);

    return $tab;
}

function find_infos($total_JSON_array, $ville, $categorie) {

    $tab = [];

    $tab_fields = CSV_file_to_array('./fields.csv');

    foreach ($tab_fields as $field) {
        foreach ($total_JSON_array as $tab_index => $value) {

            if ($value['categorie'] == $categorie && $value['lieu'] == $ville) {
                array_push($tab, $value[$field]);
            }
        }
    }

    return $tab;
}

function visualize_field($tab_infos) {
    $html = '';
    
    foreach ($tab_infos as $tab_index => $value) {
        switch ($value) {
            case 'yes':
                $html .= '<span class="field-color field-color--yes"></span>';
                break;
            case 'no':
                $html .= '<span class="field-color field-color--no"></span>';
                break;
            case 'unsure':
                $html .= '<span class="field-color field-color--unsure"></span>';
                break;
            case 'no_data':
                $html .= '<span class="field-color field-color--no-data"></span>';
                break;
        }
    }

    return $html;
}