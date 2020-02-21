<?php
// import des fonctions PHP
include_once './functions.php';
// Obtenir le nom de tous les fichiers contenus dans le repertoire 'pages'
$content_repo = get_all_file_names('./pages/');

if (!isset($_GET) || empty($_GET['view']) ||
    !in_array($_GET['view'] . '.md', $content_repo)) {
    // s'il n'y a pas de GET(view) ou qu'il n'est pas dans la liste des fichiers :
    // renvoie du client à l'accueil et interruption du chargement de la page
    header("Location: ./index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opendata Census - <?= ucfirst($_GET['view']); ?></title>

    <!-- LIBRAIRIES -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>

    <?php include_once './include/navigation.php'; ?>

    <main class="col-sm-7 mx-auto">
        <?= markdown_to_string('./pages/' . $_GET['view'] . '.md'); ?>
    </main>

    <?php include_once './include/footer.html' ?>

    <script src="./libs/jquery.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>