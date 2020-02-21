<?php
// import des fonctions PHP
include_once './functions.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opendata Census - Contact</title>

    <!-- LIBRAIRIES -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>

    <?php include_once './include/navigation.php'; ?>

    <main class="col-sm-7 mx-auto">

        <h1>Contact</h1>

        <form id="form-contact" action="contact.php" method="post">
            <div class="form-group">
                <label for="input-courriel">Adresse courriel</label>
                <input type="email" class="form-control" id="input-courriel" name="courriel">
            </div>

            <div class="form-group">
                <label for="input-objet">Objet</label>
                <input type="text" class="form-control" id="input-objet" name="objet">
            </div>

            <div class="form-group">
                <label for="input-message">Message</label>
                <textarea class="form-control" id="input-message" rows="7" name="message"></textarea>
            </div>

            <input style="display:none;" type="text" name="bot_empty" value="">
            <input style="display:none;" type="text" name="bot_nempty" value="">

            <button type="submit" class="btn btn-primary">Envoyer le courriel</button>

            <div class="alert mt-2" role="alert" id="form-contact-feedback"></div>

        </form>

    </main>

    <?php include_once './include/footer.html' ?>

    <!-- LIBRAIRIES -->
    <script src="./libs/jquery.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>

    <script src="./assets/form.js"></script>

</body>

</html>