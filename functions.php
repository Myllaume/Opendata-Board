<?php
function get_all_file_names() {
    $content_repo = scandir('./data/');
    $hidden_items = array('.', '..', '.DS_Store');
    $content_repo = array_diff($content_repo, $hidden_items);
    return $content_repo ;
}

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

    $tab_infos = [];

    $tab_fields = CSV_file_to_array('./fields.csv');

    $id_file = '';

    foreach ($tab_fields as $field) {
        foreach ($total_JSON_array as $tab_index => $value) {

            if ($value['categorie'] == $categorie && $value['lieu'] == $ville) {
                array_push($tab_infos, $value[$field]);
                $id_file = $value['id'];
            }
        }
    }

    $fields_view = '';
    $popover_content = '';
    $score = 0;

    $i = 0;

    foreach ($tab_infos as $tab_index => $value) {
        switch ($value) {
            case 'yes':
                $fields_view .= '<span class="field-color field-color--yes"></span>';
                $popover_content .= '<li>' . $tab_fields[$i] . ' : Oui</li>';
                $score++;
                break;
            case 'no':
                $fields_view .= '<span class="field-color field-color--no"></span>';
                $popover_content .= '<li>' . $tab_fields[$i] . ' : Non</li>';
                break;
            case 'unsure':
                $fields_view .= '<span class="field-color field-color--unsure"></span>';
                $popover_content .= '<li>' . $tab_fields[$i] . ' : Incertain</li>';
                break;
            case 'no data':
                $fields_view .= '<span class="field-color field-color--no-data"></span>';
                $popover_content .= '<li>' . $tab_fields[$i] . ' : Pas de données</li>';
                break;
        }

        $i++;
    }

    $html = '<a href="./view.php?view=' . $id_file . '"><div data-toggle="popover" data-trigger="hover" data-placement="bottom"
    title="Statistiques" data-content="<ul>' . $popover_content . '</ul>">' . $fields_view . '</div></a>';

    return ['HTML' => $html, 'score' => $score];
}