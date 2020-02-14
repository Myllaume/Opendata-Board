# Datacity

Création d'un repertoir de JSON normalisés. Un fichier PHP vient faire l'interface utilisateur.

## Sommaire

- Création des JSON
    - Convention de nommage
- Interface
    - Librairies utilisées

## JSON

Les fichiers JSON sont nommés tel que `STR_espace_vert.json`, soit
- les trois premières lettres du nom de la ville en majuscule ;
- le nom de la catégorie selon la norme `string_cat`, sans determinants ;
- le tout relié par des *underscores*

|  Champ |  Type |  Remarque |
|---|---|---|
|  annee | `int`  |  Année de la mise à jour la récente |
|  lieu  |  `string` | Ville concernée par les données |
|  categorie |  `string_cat` |  Sujet sur lequel portent les données |
|  id |  `string` |  Identifiant du fichier, strictement égale à son nom : si le fichier s'appelle "STR_espace_vert.json", son identifiant est "STR_espace_vert" |
|  data_loc |  `string` |  Adresse où sont disponibles les données |
|  is_open_licenced |  ``string_state`` |  Si la licene des données est ouverte |
| is_free  | `string_state`  |  Si l'accès au donnée est gratuit |
|  is_machine_readabled |  `string_state` |  Si les données peuvent être lues par un logiciel |
|  is_updated | `string_state`  | Si les données sont à jour  |
| is_easy_dowloaded  |  `string_state` | Si les données sont faciles à télécharger  |
| is_public  |  `string_state` | Si tout internaute n'a pas besoin de s'inscrire, de faire de demande et peut accéder immédiatement aux données |
|  is_numeric | `string_state`  |  Si les données sont numérisées |
|  is_on_web | `string_state`  | Si les données sont disponible sur une page web et non pas envoyées par courriel  |
| is_official  | `string_state`  |  Si les données viennent d'une institution officielle ou sur sa demande et non d'une initiative privée ou citoyenne |
|  remarques | `string`  |  Commentaires supplémentaires |
|  date_data_upload | `date`  |  Date de mise en ligne des données format `DD-MM-AAAA` |
|  data_format | `string`  |  Liste des formats de données séparés par des virgules |
|  contributeur | `string`  |  Le prénom et le nom de la personne qui a éditer le fichier JSON |
|  date_last_edit | `date`  |  Date de la dernière édition format `DD-MM-AAAA` |

### Conventions de nommage

Les `string_state` peuvent avoir trois valeurs :
- yes
- no
- unsure
- no data

Les `string_cat` correspondent aux catégories admises sur le site, selon la liste suivante :

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

## Interface

L'interface du site se présente en deux parties :
1. une visualisation générale des sets données présentés sous la forme d'un tableau ;
2. une page de visualisation d'un set de données particulier.

Le tableau est nourrit de la récolte en PHP de l'ensemble des fichiers JSON qu'il est possible de consulter individuellement sur la seconde page. Selon les données fournies par les JSON, le tableau présente des visualisation et statistiques calculées selon l'ensemble du corpus qui est étudié par l'algorithme au chargement de la page.

Tout JSON ajouté, supprimé, mis à jour, modifie immédiatement la visualisation globale.

### Librairies utilisées

Liste des librairies utilisées pour la réalisation du site :
- [Bootstrap](https://getbootstrap.net/)
- [DataTables](https://datatables.net/)