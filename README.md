# Datacity
 
Création d'un repertoir de JSON normalisés. Un fichier PHP vient faire l'interface utilisateur.

## JSON

|  Champ |  Type |  Remarque |
|---|---|---|
|  annee | `int`  |  ex : 2011 |
|  lieu  |  `string` |   |
|  categorie |  `string` |   |
|  data_loc |  `string` |  Adresse où sont disponibles les données |
|  is_open_licenced |  ``string_cat`` |  Si la licene des données est ouverte |
| is_free  | `string_cat`  |  Si l'accès au donnée est gratuit |
|  is_machine_readabled |  `string_cat` |  Si les données peuvent être lues par un logiciel |
|  is_updated | `string_cat`  | Si les données sont à jour  |
| is_easy_dowloaded  |  `string_cat` | Si les données sont faciles à télécharger  |
| is_public  |  `string_cat` | Si tout internaute n'a pas besoin de s'inscrire, de faire de demande et peut accéder immédiatement aux données |
|  is_numeric | `string_cat`  |  Si les données sont numérisées |
|  is_on_web | `string_cat`  | Si les données sont disponible sur une page web et non pas envoyées par courriel  |
| is_official  | `string_cat`  |  Si les données viennent d'une institution officielle ou sur sa demande et non d'une initiative privée ou citoyenne |
|  remarques | `string`  |  Commentaires supplémentaires |
|  date_data_upload | `date`  |  Date de mise en ligne des données |
|  data_format | `string`  |  Liste des formats de données séparés par des virgules |
|  contributeur | `string`  |  Le prénom et le nom de la personne qui a éditer le fichier JSON |
|  date_last_edit | `date`  |  Date de la dernière édition |

Les `string_cat` peuvent avoir trois valeurs :
- yes
- no
- unsure
- no data