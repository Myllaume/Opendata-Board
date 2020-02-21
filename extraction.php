<?php
$file_mass_JSON_path = './data/mass_data.json';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extraction de données - Opendata Census</title>

    <!-- LIBRAIRIES -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>

    <main class="col-sm-7 pt-5 mx-auto">
        <?php
        $extract = file_get_contents($file_mass_JSON_path);
        if (!$extract) {
            echo '<div class="alert alert-warning" role="alert">Le fichier "mass_data.json"
                n\'a pas été détecté dans le repertoire "/data".</div>';
            exit;
        }
        ?>
        
        <div class="alert alert-info" role="alert">
            Le fichier "mass_data.json" a été détecté dans le repertoire "/data".
                Il est prêt à être extrait
            <hr>
            <strong>Attention !</strong> le fichier "mass_data.json" sera supprimé à la fin de
                l'extration.
            <br>
            <a class="btn btn-warning mt-2" href="?action=extract">Extraire les données</a>
        </div>

        <?php
        if (!isset($_GET) || empty($_GET['action']) || $_GET['action'] !== 'extract') {
            exit;
        }

        include_once './functions.php';
        ?>

        <?php
        $is_ok = mass_JSON_create($file_mass_JSON_path);
        $is_ok &= unlink($file_mass_JSON_path);

        if (!$is_ok) {
            echo '<div class="alert alert-danger" role="alert">Erreur fatale</div>';
            exit;
        }
        ?>

        <div class="alert alert-success" role="alert">
            Extraction terminée.<br/>
            Fichier "mass_data.json" supprimé.
        </div>
    </main>

</body>

</html>