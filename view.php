<?php
// import des fonctions PHP
include_once './functions.php';
// Obtenir le nom de tous les fichiers contenus dans le repertoire 'data'
$content_repo = get_all_file_names('./data/');

if (!isset($_GET) || empty($_GET['view']) ||
    !in_array($_GET['view'] . '.json', $content_repo)) {
    // s'il n'y a pas de GET(view) ou qu'il n'est pas dans la liste des fichiers :
    // renvoie du client à l'accueil et interruption du chargement de la page
    header("Location: ./index.php");
    exit;
}

// stockage des informations du JSON
// '$_GET['view']' est le nom du fichier auquel il suffit d'ajouter le chemin et l'extension
$JSON_file = JSON_file_to_array('./data/' . $_GET['view'] . '.json');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datacity - Accueil</title>

    <!-- LIBRAIRIES -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/style.css">
</head>

<body class="p-2 col-sm-7">

    <?php
    if (isset($JSON_file['ville']) && !empty($JSON_file['ville'])
        && isset($JSON_file['departement']) && !empty($JSON_file['departement'])
        && isset($JSON_file['categorie']) && !empty($JSON_file['categorie'])):
    ?>

    <h1><?= $JSON_file['ville'] ?> <small>de <?= $JSON_file['departement'] ?></small><br/><?= $JSON_file['categorie'] ?></h1>

    <?php
    endif;
    ?>

    <?php
    if (isset($JSON_file['date_data_upload']) && !empty($JSON_file['date_data_upload'])):
    ?>

    <h2>Données mises en ligne le <?= $JSON_file['date_data_upload'] ?></h2>

    <?php
    endif;
    ?>

    <a href="./index.php" class="btn btn-secondary my-2">Retour à l'accueil</a>

    <h2>Description</h2>

    <?php
    if (isset($JSON_file['institution']) && !empty($JSON_file['institution'])):
    ?>

    <p>Mis à disposition par <?= $JSON_file['institution'] ?>.</p>

    <?php
    endif;
    ?>

    <ul class="list-group my-2">
    <?php
    // recherche...
    $field_file = CSV_file_to_array('./fields.csv'); // récupération des lignes du CSV contenant toutes les infos
    $all_fields = $field_file[0]; //... des champs d'information
    $all_fields_name = $field_file[1]; //... de leur nom complet
    $all_fields_description = $field_file[3]; //... et de leur description

    $i = 0; // incrémentation qui va permettre de récupérer les éléments pour chaque élément

    // pour chaque champ du JSON...    
    foreach ($JSON_file as $key => $value) {
        if (!in_array($key, $all_fields)) {
            //... s'il s'agit bien d'un champ référencé ...
            continue;
        }

        $poppover = 'data-toggle="popover" data-trigger="hover" data-placement="left"
            data-content="' . $all_fields_description[$i] . '"';

        if ($value === "true" || $value === true) {
            echo '<li class="list-group-item list-group-item-success" ' . $poppover . ' >' . $all_fields_name[$i] . ' Oui</li>';
        } elseif ($value === "false" || $value === false) {
            echo '<li class="list-group-item list-group-item-danger" ' . $poppover . ' >' . $all_fields_name[$i] . ' Non</li>';
        } else {
            echo '<li class="list-group-item list-group-item-dark" ' . $poppover . ' >' . $all_fields_name[$i] . ' Incertain</li>';
        }

        $i++;
    }
    ?>
    </ul>

    <a href="<?= $JSON_file['data_loc'] ?>" target="_target" class="btn btn-primary my-2">Accéder aux données</a>

    <?php include_once './include/footer.html' ?>

    <script src="./libs/jquery.min.js"></script>
    <script src="./libs/popper.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>

    <script>
        // activation des Poppovers
        $('[data-toggle="popover"]').popover({ trigger: "hover" });
    </script>

</body>

</html>