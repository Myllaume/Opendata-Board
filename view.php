<?php
// import des fonctions PHP
include_once './functions.php';
// Obtenir le nom de tous les fichiers contenus dans le repertoire 'data'
$content_repo = get_all_file_names('./data/');

if (!isset($_GET) || empty($_GET['view']) ||
    !in_array($_GET['view'] . '.json', $content_repo)) {
    // s'il n'y a pas de GET(view) ou qu'il n'est pas dans la liste des fichier
    // renvoie du client et interruption du chargement de la page
    header("Location: ./index.php");
    exit;
}
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
    // stockage des informations du JSON
    // '$_GET['view']' est le nom du fichier auquel il suffit d'ajouter le chemin et l'extension
    $JSON_file = JSON_file_to_array('./data/' . $_GET['view'] . '.json');
    ?>

    <h1><?= $JSON_file['lieu'] ?> / <?= $JSON_file['categorie'] ?> / <?= $JSON_file['annee'] ?></h1>

    <a href="./index.php" class="btn btn-secondary my-2">Retour à l'accueil</a>

    <h2>Description</h2>

    <p><?= $JSON_file['remarques'] ?></p>
    <p>Mis à disposition par <?= $JSON_file['institution'] ?>.</p>
    <p>Formats disponibles : <?= $JSON_file['data_format'] ?>.</p>

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
        
        //... préparer son affichage
        switch ($value) {
            case true:
                echo '<li class="list-group-item list-group-item-success" ' . $poppover . ' >' . $all_fields_name[$i] . ' Oui</li>';
                break;
            case false:
                echo '<li class="list-group-item list-group-item-danger" ' . $poppover . ' >' . $all_fields_name[$i] . ' Non</li>';
                break;
            default:
                echo '<li class="list-group-item list-group-item-dark" ' . $poppover . ' >' . $all_fields_name[$i] . ' Incertain</li>';
                break;
        }
        $i++;
    }
    ?>
    </ul>

    <p>Données modifiées par <?= $JSON_file['contributor'] ?> le <?= $JSON_file['date_last_edit'] ?>.</p>

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