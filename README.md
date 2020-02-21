# Opendata Board

Opendata Board est une **application web de visualisation de données** : des fichiers JSON stockés en masse sont croisés pour obtenir un tableau complet au sujet de l'open-data dans les communes.

Chaque fichier JSON correspond à un set de donnéess. Il indique la ville et la catégorie qui le concerne ainsi que sa réponse à différents critères posés par la communauté *Open Knowledge Foundation*.

## Sommaire

- [Interface](https://github.com/Myllaume/Opendata-Board#interface)
- [Création des fichiers JSON](https://github.com/Myllaume/Opendata-Board#creation-fichiers-json)
    - [Convention de nommage](https://github.com/Myllaume/Opendata-Board#conventions-de-nommage)
- [Alimentation du site](https://github.com/Myllaume/Opendata-Board#alimentation-du-site)
    - [Decoupage fichiers JSON](https://github.com/Myllaume/Opendata-Board#decoupage-fichiers-json)
- [Librairies utilisées](https://github.com/Myllaume/Opendata-Board#librairies-utilis%C3%A9es)

## Interface

Le site est divisé en 4 parties :
1. (`index.php`) visualisation générale des sets données présentés sous la forme d'un tableau ;
2. (`view.php`) page de visualisation d'un set de données particulier ;
3. (`read.php`) page de lecture des fichiers ;
4. (`contact.php`) page de contact.

Le tableau **(1)** est nourrit de la récolte en PHP de l'ensemble des fichiers JSON (`.json`) qu'il est possible de consulter individuellement **(2)**. Selon les données fournies par les JSON, le tableau présente des visualisation et statistiques calculées selon l'ensemble du corpus qui est étudié par l'algorithme au chargement de la page.

Tout fichier JSON (`.json`) ajouté, supprimé, mis à jour, modifie immédiatement la visualisation globale.

D'autre part, il est possible d'ajouter des pages de texte au site sous forme de fichier markdown (`.md`).

Ces traitements sont permis par les fonctions commentées du fichier `function.php`.

## Creation des fichiers JSON

Les fichiers JSON sont nommés tel que `STRASB_espace_vert.json`, soit
- les six premières lettres du nom de la ville en majuscule ;
- le nom de la catégorie selon la [norme `string_cat`](https://github.com/Myllaume/Opendata-Board#conventions-de-nommage), sans determinants ;
- le tout relié par des *underscores* et sans espaces, accents.

Chaque fichier JSON contient un unique objet écrit selon le schéma décrit ci-dessous :

|  Champ |  Type |  Remarque |
|---|---|---|
|  titre |  `string` |  Titre du jeu de données |
|  id |  `string` |  Identifiant du fichier, strictement équivalent à son nom : si le fichier s'appelle "STR_espace_vert.json", son identifiant est "STR_espace_vert", sans espace, caractères spéciaux etc. |
|  ville  |  `string` | Ville concernée par les données |
|  departement  |  `string` | Département de la ville concernée par les données |
|  categorie |  `string_cat` |  Sujet sur lequel portent les données selon la [norme `string_cat`](https://github.com/Myllaume/Opendata-Board#conventions-de-nommage) |
|  data_loc |  `string` |  Adresse URL où sont disponibles les données |
|  institution |  `string` |  Organisation, entreprise ou institution ayant créé le jeu de données |
|  is_exist |  ``boolean`` |  Si les données existent bien et peuvent donc être indexées |
|  is_open_licenced |  ``boolean`` |  Si la licence des données est ouverte |
| is_free  | `boolean`  |  Si l'accès aux données est gratuit |
|  is_machine_readabled |  `boolean` |  Si les données peuvent être lues par un logiciel |
|  is_updated | `boolean`  | Si les données sont à jour  |
| is_easy_dowloaded  |  `boolean` | Si les données sont faciles à télécharger  |
| is_public  |  `boolean` | Si les internautes n'ont pas besoin de s'inscrire, de faire de demande et peuvent accéder immédiatement aux données |
|  is_on_web | `boolean`  | Si les données sont disponibles sur une page web et non pas envoyées par courriel  |
|  date_data_upload | `date`  |  Date de mise en ligne des données format `DD-MM-AAAA` |

Laissez vide les champs du JSON pour lesquels il manque les informations.

### Conventions de nommage

Les `string_cat` correspondent aux catégories admises sur le site, selon la liste d'exemple suivante :

|  Nom complet |  Notation JSON |
|---|---|
|  Pistes cyclables | `pistes_cyclables`  |
|  Disponibilité des vélos en libre service | `velo_libre_service`  |
|  Liste des prénoms | `liste_prenom`  |
| Subventions aux asso  | `subventions_associations`  |
| Localisation des espaces verts  | `espaces_verts`  |
|  Chantier en cours sur l'espace public | `chantier_espace_public`  |
|  Budget | `budget`  |
|  Marchés publics | `marche_public`  |
|  Horaires transports | `horaires_transports`  |
|  Evenements culturels | `evenement_culturel`  |
|  Permis de construire | `permis_construire`  |
|  Localisation des arbres | `localisation_arbres`  |
|  Menus des cantines | `menus_cantines`  |
|  Autorisation des étalages et terrasses | `etalages_terrasses`  |
|  Anomalies signalées par les citoyens sur la voie publique | `anomalie_voie_publique`  |

## Alimentation du site

Pour ajouter un set de données, il faut glisser un fichier JSON (`.json`) dans le repertoire `/data` du site.
Le fichier est automatiquement affiché dans le tableau **(1)** et est visualisable **(2)**.

Pour ajouter une page de texte, il faut ajouter un fichier markdown (`.md`) dans le repertoire `/pages` du site;
Le fichier est automatiquement ajouté à la barre navigation est lisible **(3)**.

### Decoupage fichiers JSON

Il se peut qu'on extrait d'outils comme [Workbenchdata](https://app.workbenchdata.com/) de gros fichiers JSON composés de plusieurs objets et qu'il faut donc découper. La page `/extraction.php` permet de découper un fichier nommé `mass_data.json` glissé dans le repertoire `/data` en plusieurs fichiers.
Le fichier `mass_data.json` est supprimé à la fin de l'opération.

## Librairies utilisées

Liste des librairies utilisées pour la réalisation du site :
- [Bootstrap](https://getbootstrap.net/)
- [DataTables](https://datatables.net/)
- [Popper](https://popper.js.org/)
- [Parsedown](https://github.com/erusev/parsedown)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)