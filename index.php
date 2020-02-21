<?php
// import des fonctions PHP
include_once './functions.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opendata Census</title>

    <!-- LIBRAIRIES -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="./libs/datatables/datatables.css">
    <link rel="stylesheet" href="./assets/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:600|Oswald:600&display=swap" rel="stylesheet">
</head>

<body>

    <?php include_once './include/navigation.php'; ?>
  
    <?php
    // Obtenir le nom de tous les fichiers contenus dans le repertoire 'data'
    $content_repo = get_all_file_names('./data/');

    // Avec chacun des fichiers, remplir le tableau '$all_JSON_content',
    // il contient dorénavant l'ensemble de la data issue de tous les fichiers
    $all_JSON_content = [];
    foreach ($content_repo as $tab_index => $JSON_file_name) {
        $json_content = JSON_file_to_array('./data/' . $JSON_file_name);

        // si le fichier n'existe pas
        // si les champs 'lieu' ou 'categorie' du JSON sont vides, le fichier n'est pas
        // enregistré pour être affiché dans le tableau
        if (!$json_content || empty($json_content['ville']) || empty($json_content['categorie'])) {
            continue;
        }

        array_push($all_JSON_content, $json_content);
    }

    // Extraire la liste des catégories et villes stockées,
    // en fonction de leur clé
    $tab_categories = find_all_keys($all_JSON_content, 'categorie');
    $tab_villes = find_all_keys($all_JSON_content, 'ville');
    ?>

    <div class="cParallaxe">

      <div class="d-flex flex-column justify-content-around align-items-center petitbouton">
        <h1 class="titre-site">Opendata Census France</h1>

        <button type="button" class="btn btn-dark" onclick="scrollToTable();">Accéder aux données</button>

        <p class="text-intro col-md-5">Analyse de <span class="badge badge-secondary"><?= count($content_repo); ?> jeux de données</span> ouverts portés par <span class="badge badge-secondary"><?= count($tab_villes); ?> communes françaises</span> de plus de 10 000 habitants : Horaires des transports en commun, budget administratif… 15 thématiques sont analysées dans un tableau dynamique donnant une vue d’ensemble sur l’open-data en France.</p>
      </div>

    </div>

    <table class="table" id="tab">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Ville</th>
                <?php foreach ($tab_categories as $categorie): ?>
                <th><span class="text-rotate"><?= $categorie ?></span></th>
                <?php endforeach; ?>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab_villes as $ville): ?>
            <tr>
                <th scope="row"><?= $ville ?></th>
                <?php foreach ($tab_categories as $categorie): ?>
                <td class="sum-cell">
                    <?php
                    $infos = find_infos($all_JSON_content, $ville, $categorie);
                    echo $infos['HTML']; // lien et Poppover du set de données
                    echo $infos['score']; // score du set de données
                    ?>
                </td>
                <?php endforeach; ?>
                <th class="total-row">0</th>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Moyenne : </th>
                <?php foreach ($tab_categories as $categorie): ?>
                <th class="total-col">0</th>
                <?php endforeach; ?>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <?php include_once './include/footer.html' ?>

    <!-- LIBRAIRIES -->
    <script src="./libs/jquery.min.js"></script>
    <script src="./libs/popper.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script src="./assets/table.js"></script>

    <script>
        $(document).ready( function () {
            // activation du tableau
            var table = $('#tab').DataTable({
                paging: false,
                searching: false
            });

            // calcul et affichage des totaux
            showTotals();

        });

        function scrollToTable() {
            window.scrollTo({
                top: document.querySelector('#tab').offsetTop - 50,
                behavior: 'smooth'
            });
        }

        // activation des Poppovers
        $('[data-toggle="popover"]').popover({ trigger: "hover", html:true });
    </script>

</body>

</html>
