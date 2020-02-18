<?php
/**
 * Chercher tous les fichiers dans un repertoire
 */

function get_all_file_names($path) {
    $content_repo = scandir($path);
    // liste des fichiers à exclure :
    $hidden_items = array('.', '..', '.DS_Store');
    // séparation des fichiers et exclus
    $content_repo = array_diff($content_repo, $hidden_items);
    return $content_repo ;
}

/**
 * Obtenir un tableau d'une fichier JSON
 */

function JSON_file_to_array($JSON_file_path) {
    $json_file = file_get_contents($JSON_file_path);
    $json_file = json_decode($json_file, true);
    return $json_file;
}

function CSV_file_to_array($CSV_file_path, $line) {
    $return_tab = [];

    $csv_file = file_get_contents($CSV_file_path);
    $CSV_rows = str_getcsv($csv_file, "\n");

    foreach($CSV_rows as &$row) {
        $row = str_getcsv($row, ",");
        array_push($return_tab, $row);
    }
    
    return $return_tab[$line];
}

/**
 * Pour un tableau JSON entré : trouver les entrées correspondany
 * à la clé entrée
 */

function find_all_keys($total_JSON_array, $key) {
    $tab = [];

    foreach ($total_JSON_array as $tab_index => $value) {
        array_push($tab, $value[$key]);
    }

    $tab = array_unique($tab); // suppression des doublons

    return $tab;
}

/**
 * Pour une ville et une catégorie données, chercher toutes les infos
 * les concernant dans le tableau de données
 * 
 * Générer le score et le Popper pour ces informations
 */

function find_infos($total_JSON_array, $ville, $categorie) {

    $tab_infos = [];

    // lecture du CSV contenant l'ensemble des champs d'info
    $all_fields = CSV_file_to_array('./fields.csv', 0);

    $id_file = '';

    foreach ($all_fields as $field) {
        // pour chaque champs...
        foreach ($total_JSON_array as $tab_index => $value) {
            // chercher dans chaque fichier JSON ce champ...
            if ($value['categorie'] == $categorie && $value['lieu'] == $ville) {
                // si le JSON a la bonne catégorie et la bonne ville
                array_push($tab_infos, $value[$field]); // stockage de l'information
                $id_file = $value['id'];
            }
        }
    }

    // variables à compléter avant renvoie
    $fields_view = '';
    $popover_content = '';
    $score = 0;

    $i = 0;

    // lecture du CSV contenant les noms complets des champs d'info
    $all_fields_name = CSV_file_to_array('./fields.csv', 1);

    foreach ($tab_infos as $tab_index => $value) {
        // pour chaque information stockée
        // générer l'affichage et le score
        switch ($value) {
            case true:
                $fields_view .= '<span class=\'field-color field-color--yes\'></span>';
                $popover_content .= '<li class=\'list-group-item list-group-item-success\'>' . $all_fields_name[$i] . ' : Oui</li>';
                $score++;
                break;
            case false:
                $fields_view .= '<span class=\'field-color field-color--no\'></span>';
                $popover_content .= '<li class=\'list-group-item list-group-item-danger\'>' . $all_fields_name[$i] . ' : Non</li>';
                break;
            default:
                $fields_view .= '<span class=\'field-color field-color--no-data\'></span>';
                $popover_content .= '<li class=\'list-group-item list-group-item-dark\'>' . $all_fields_name[$i] . ' : Incertain</li>';
                break;
        }

        $i++;
    }

    $html = '<a href="./view.php?view=' . $id_file . '"><div data-toggle="popover" data-trigger="hover" data-placement="right"
    title="Statistiques" data-content="<ul class=\'list-group || little-list-group\'>' . $popover_content . '<ul>">' . $fields_view . '</div></a>';

    return ['HTML' => $html, 'score' => $score];
}