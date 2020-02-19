<?php
/**
 * Chercher tous les fichiers dans un repertoire
 * @param string $path Chemin du fichier vers le repertoir à analyser
 * @return array Tableau contenant la liste des fichiers
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
 * Obtenir un tableau d'un fichier JSON
 * @param string $path Chemin du fichier vers le fichier JSON a transformer
 * @return array Tableau contenant les données du fichier JSON
 */

function JSON_file_to_array($path) {
    $json_file = file_get_contents($path);

    if (!$json_file) {
        return false;
    }

    $json_file = json_decode($json_file, true);
    return $json_file;
}

/**
 * Obtenir un tableau d'un fichier CSV
 * @param string $path Chemin du fichier vers le fichier CSV a transformer
 * @return array Tableau contenant les lignes du fichier CSV :
 * la key [0] donnera accès aux données de la ligne 1 du fichier
 */

function CSV_file_to_array($path) {
    $return_tab = [];

    $csv_file = file_get_contents($path);
    $CSV_rows = str_getcsv($csv_file, "\n");

    foreach($CSV_rows as &$row) {
        $row = str_getcsv($row, ",");
        array_push($return_tab, $row);
    }
    
    return $return_tab;
}

/**
 * Obtenir du code HTML par l'inteprêtation d'un fichier markdown
 * @param string $path Chemin du fichier vers le fichier markdown a transformer
 * @return string Code HTML à inteprêter par le navigateur
 */

function markdown_to_string($path) {
    $markdown_content = file_get_contents($path);

    include_once './libs/parsedown/Parsedown.php';
    $parsedown = new Parsedown();
    return $parsedown->text($markdown_content);
}

/**
 * Pour un tableau JSON entré : trouver les entrées correspondany
 * à la clé entrée
 * @param array $total_JSON_array Tableau contenant toutes les données JSON du site
 * @param string $key Nom de la clé des fichiers retourner
 * @return array Tableau des données gardées sous la clé renseignée
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
 * 
 * @param array $total_JSON_array Tableau contenant toutes les données JSON du site
 * @param string $ville Nom de la ville, condition de renvoie
 * @param string $categorie Nom de la catégorie, condition de renvoie
 * @return array Tableau de renvoie du HTML et du score
 */

function find_infos($total_JSON_array, $ville, $categorie) {

    $tab_infos = [];

    // lecture du CSV
    $field_file = CSV_file_to_array('./fields.csv');

    $all_fields = $field_file[0];

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

    $field_file = CSV_file_to_array('./fields.csv');
    // liste des noms complets des champs d'info
    $all_fields_name = $field_file[1];
    // liste des scores
    $all_fields_score = $field_file[2];

    foreach ($tab_infos as $tab_index => $value) {
        // pour chaque information stockée
        // générer l'affichage et le score

        if ($value === true) {
            $fields_view .= '<span class=\'field-color field-color--yes\'></span>';
            $popover_content .= '<li class=\'list-group-item list-group-item-success\'>' . $all_fields_name[$i] . ' : Oui</li>';
            $score += $all_fields_score[$i];
        } elseif ($value === false) {
            $fields_view .= '<span class=\'field-color field-color--no\'></span>';
            $popover_content .= '<li class=\'list-group-item list-group-item-danger\'>' . $all_fields_name[$i] . ' : Non</li>';
        } else {
            $fields_view .= '<span class=\'field-color field-color--unsure\'></span>';
            $popover_content .= '<li class=\'list-group-item list-group-item-dark\'>' . $all_fields_name[$i] . ' : Incertain</li>';
        }

        $i++;
    }

    $html = '<a href="./view.php?view=' . $id_file . '"><div data-toggle="popover" data-trigger="hover" data-placement="right"
    title="Statistiques" data-content="<ul class=\'list-group || little-list-group\'>' . $popover_content . '<ul>">' . $fields_view . '</div></a>';

    return ['HTML' => $html, 'score' => $score];
}