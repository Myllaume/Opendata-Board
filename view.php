<?php
include_once './functions.php';
$content_repo = get_all_file_names();

if (!isset($_GET) || empty($_GET['view']) ||
    !in_array($_GET['view'] . '.json', $content_repo)) {
    
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

    <!-- <link rel="stylesheet" href="/nantarbourg/libs/bootstrap/css/bootstrap-grid.min.css"> -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>

    <h1>Data census France</h1>

    <a href="./index.php" class="btn btn-secondary my-5">Retour à l'accueil</a>

    <pre>
        <?php
            print_r(JSON_file_to_array('./data/' . $_GET['view'] . '.json'));
        ?>
    </pre>

    <footer>
        <p>Créé par les étudiants de la licence professionnelle MIND de l'IUT Bordeaux Montaigne.</p>
    </footer>

    <!-- <script src="./libs/jquery.min.js"></script> -->
    <!-- <script src="./libs/popper.min.js"></script> -->
    <!-- <script src="./libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script> -->

</body>

</html>