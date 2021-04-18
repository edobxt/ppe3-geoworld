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
            $continent = $_REQUEST["continent"];
            $pays = toFetch("SELECT * FROM country WHERE continent = '$continent'");
        ?>
            <h1>Pays en <?php echo $continent ?></h1>
            <br>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Region</th>
                        <th>SurfaceArea</th>
                        <th>IndepYear</th>
                        <th>Population</th>
                        <th>LifeExpectancy</th>
                        <th>GNP</th>
                        <th>GNPOld</th>
                        <th>LocalName</th>
                        <th>GovernmentForm</th>
                        <th>HeadOfState</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($response = $pays->fetch())
                    {
                    ?>
                        <tr>
                            <td><?php echo $response["Name"] ?></td>
                            <td><?php echo $response["Region"] ?></td>
                            <td><?php echo $response["SurfaceArea"] ?></td>
                            <td><?php echo $response["IndepYear"] ?></td>
                            <td><?php echo $response["Population"] ?></td>
                            <td><?php echo $response["LifeExpectancy"] ?></td>
                            <td><?php echo $response["GNP"] ?></td>
                            <td><?php echo $response["GNPOld"] ?></td>
                            <td><?php echo $response["LocalName"] ?></td>
                            <td><?php echo $response["GovernmentForm"] ?></td>
                            <td><?php echo $response["HeadOfState"] ?></td>
                        </tr>
                    <?php
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
            <h1>Liste des pays parlant : <?php echo $langue ?></h1>
            <center>
                <br>
                <div class="btn-group" style="color: #fff">
                    <a href="view_countries.php?langue=<?php echo $idLangue ?>&isOfficial=any" type="button" class="btn btn-primary btn-lg">Tous</a>
                    <a href="view_countries.php?langue=<?php echo $idLangue ?>&isOfficial=true" type="button" class="btn btn-info btn-lg">Officielle</a>
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
                                    <h5 class="card-title"><?php echo $nomPays . $officiel ?></h5>
                                    <h5><small><?php echo $pourcentage ?>% de la population</small></h5>
                                    <a href="<?php echo 3 ?>" class="card-link">Voir plus</a>
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