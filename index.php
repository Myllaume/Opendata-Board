<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datacity - Accueil</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>

<body>

    <?php
    // récupération du fichier CSV contenant le nom de toutes les villes
    $tab_villes_file = file_get_contents("./cities.csv");
    $tab_categories_file = file_get_contents("./categories.csv");
    // transformation du fichier CSV en array
    $tab_villes = str_getcsv($tab_villes_file, ",");
    $tab_categories = str_getcsv($tab_categories_file, ",");
    ?>

    <h1>Data census France</h1>

    <table class="table" id="tab">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Ville</th>
                <?php foreach ($tab_categories as $categorie): ?>
                <th><?= $categorie ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab_villes as $ville): ?>
            <tr>
                <th scope="row"><?= $ville ?></th>
                <?php foreach ($tab_categories as $categorie): ?>
                <td>/</td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <footer>
        <p>Créé par les étudiants de la licence professionnelle MIND de l'IUT Bordeaux Montaigne.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	    crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#tab').DataTable();
        });
    </script>

</body>

</html>