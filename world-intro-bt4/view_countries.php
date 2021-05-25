<?php  
    // Ajout du header
    require_once 'header.php';
    // Lien vers les méthodes
    require_once 'inc/manager-db.php';
    // Initialisation de la session
    session_start(); 

    // Obtenir l'url de la page
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //echo $url;
?>

<style>
    body {
        overflow-y: scroll;
    }
</style>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <?php
        // Voir les pays d'un continent
        if (isset($_REQUEST["continent"]))
        {
            // Récupérer le continent sélectionné
            $continent = $_REQUEST["continent"];
            // Récupérer la liste des pays du continent en question
            $requete = "SELECT * FROM country WHERE continent = '$continent'";
            $pays = toFetch($requete);
            // Récupérer les colonnes de la table country
            $colonnePays = getAllColumns($requete);
            // Enlever les colonnes indésirables
            unset($colonnePays[0]); // id
            unset($colonnePays[1]); // code
            unset($colonnePays[3]); // continent
            unset($colonnePays[14]); // capital
            unset($colonnePays[15]); // Code2

        ?>
            <h1 style="float:left;">Pays en <?php echo $continent ?></h1>
            <!-- Retour vers la page d'accueil -->
            <a href="index.php?data=continent" class="btn btn-secondary btn-lg" style="float:right;"><strong>RETOUR</strong></a>
            <div style="clear: both;"></div>
            
            <br>
            <!-- Tableau listant les pays d'un continent -->
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <?php
                        // Affichage des colonnes du tableau
                        foreach ($colonnePays as $colonne) {
                            echo "<th>" . $colonne . "</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        // Affichage des informations du tableau
                        while ($response = $pays->fetch())
                        {
                            echo "<tr>";
                            foreach ($colonnePays as $colonne) {
                                $info = (!empty($response[$colonne])) ? $response[$colonne] : "N/A";
                                echo "<td>" . $info . "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                </tbody>
            </table>
            
        <?php
        }

        // Voir les pays ou la langue est parlé
        if (isset($_REQUEST["langue"]))
        {
            // id de la langue choisi
            $idLangue = $_REQUEST["langue"];
            //echo $langue;
            // Obtenir le nom de la langue choisi
            $requete1 = requete("SELECT name FROM language WHERE id = $idLangue");
            $langue = $requete1["name"];
            //echo $langue;
            // Tri des pays
            $sortAddQuery = "";
            // Afficher les pays en fonction de si la langue est officielle ou pas
            if (isset($_REQUEST["isOfficial"]))
            {
                $sort = $_REQUEST["isOfficial"];
                switch ($sort)
                {
                    case "any":
                        $sortAddQuery = "";
                    break;

                    case "true":
                        $sortAddQuery = "AND isOfficial = 'T' ";
                    break;

                    case "false":
                        $sortAddQuery = "AND isOfficial = 'F' ";
                    break;
                }
            }
            // Obtenir la liste des pays où la langue est parlée
            $requete2 = "SELECT * FROM countrylanguage "
            . "LEFT JOIN country ON countrylanguage.idCountry = country.id "
            . "WHERE idLanguage = $idLangue "
            . $sortAddQuery
            . "ORDER BY country.Name ASC";
            //echo $requete2;
            $pays = toFetch($requete2);
            ?>
            <h1 style="float:left;">Liste des pays parlant : <?php echo $langue ?></h1>
            <!-- Retour vers la page d'accueil -->
            <a href="index.php?data=langues" class="btn btn-secondary btn-lg" style="float:right;"><strong>RETOUR</strong></a>
            <div style="clear: both;"></div>
            <center>
                <br>
                <div class="btn-group" style="color: #fff">
                    <!-- Tous les pays parlant la langue -->
                    <a href="view_countries.php?langue=<?php echo $idLangue ?>&isOfficial=any" type="button" class="btn btn-primary btn-lg">Tous</a>
                    <!-- Pays dont c'est la langue officielle -->
                    <a href="view_countries.php?langue=<?php echo $idLangue ?>&isOfficial=true" type="button" class="btn btn-info btn-lg">Officielle</a>
                    <!-- Pays dont ce n'est pas la langue officielle -->
                    <a href="view_countries.php?langue=<?php echo $idLangue ?>&isOfficial=false" type="button" class="btn btn-secondary btn-lg">Non-officielle</a>
                </div>
            </center>
            <br>
            <div class="container">
                <div class="row">
                    <?php
                    while ($response = $pays->fetch())
                    {
                        // id du pays parlant la langue
                        $idPays = $response["idCountry"];
                        // Informations du pays
                        $requete3 = "SELECT * FROM country WHERE id = $idPays";
                        $infoPays = requete($requete3);
                        // Nom du pays
                        $nomPays = $infoPays["Name"];
                        // Informations concernant la façon dont
                        // la langue est parlée dans le pays
                        $requete4 = "SELECT * FROM countrylanguage WHERE idCountry = $idPays AND idLanguage = $idLangue";
                        $infoLangue = requete($requete4);
                        // Pourcentage d'utilisation de la langue
                        $pourcentage = $infoLangue["Percentage"];
                        // Définir s'il s'agit de la langue officielle du pays
                        $officiel = ($infoLangue["IsOfficial"] == "T") ? " (officielle)" : "";
                    ?>
                        <div class="col-sm-4">
                            <div class="card" style="width: 20rem; margin: 10px;">
                                <div class="card-body">
                                    <!-- Nom du pays parlant la langue -->
                                    <h5 class="card-title"><?php echo $nomPays . $officiel ?></h5>
                                    <!-- Pourcentage de la population parlant la langue -->
                                    <h5><small><?php echo $pourcentage ?>% de la population</small></h5>
                                    <!-- Lien vers la fiche du pays parlant la langue -->
                                    <a href="<?php echo "country_profile.php?idCountry=$idPays" ?>" class="card-link">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>