<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datacity - Accueil</title>

    <!-- <link rel="stylesheet" href="/nantarbourg/libs/bootstrap/css/bootstrap-grid.min.css"> -->
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    include_once './functions.php';

    $content_repo = scandir('./data/');
    $hidden_items = array('.', '..', '.DS_Store');
    $content_repo = array_diff($content_repo, $hidden_items);
    ?>

        <?php
            $total_tab = [];
            foreach ($content_repo as $tab_index => $JSON_file_name):
                array_push($total_tab, JSON_file_to_array('./data/' . $JSON_file_name));
            endforeach;

            $tab_categories = find_all_keys($total_tab, 'categorie');
            $tab_villes = find_all_keys($total_tab, 'lieu');
        ?>

<a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">Dismissible popover</a>

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
                <td>
                    <?php
                    $infos = find_infos($total_tab, $ville, $categorie);
                    echo visualize_field($infos)['HTML'];
                    echo visualize_field($infos)['score'];
                    ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <footer>
        <p>Créé par les étudiants de la licence professionnelle MIND de l'IUT Bordeaux Montaigne.</p>
    </footer>

    <script src="./libs/jquery.min.js"></script>
    <script src="./libs/popper.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./libs/bootstrap/js/bootstrap.min.js"></script>

    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script>
        // dynamisation du tableau
        $(document).ready( function () {
            $('#tab').DataTable();
        });

        $('[data-toggle="popover"]').popover({ trigger: "hover", html:true });
    </script>

</body>

</html>