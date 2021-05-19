<?php  
  // Ajout du header
  require_once 'header.php';
  // Lien vers les méthodes
  require_once 'inc/manager-db.php';
  // Initialisation de la session
  session_start(); 
?>

<style>
body {
    overflow-y: scroll;
}

.card-link:hover {
    text-decoration: underline;
}
</style>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <center>
            <h1 style="color:#17A589;">Bienvenue sur GeoWorld</h1>
            <h6><em>Communiquées par l'institut Official Statistics of Finland (2006), consulter les données
                    géopolitiques et économiques de la planète. </em></h6>
            <br>
            <h3>Observez les données par :</h3>
            <?php
            if (isset($_REQUEST["data"]))
            {
                switch ($_REQUEST["data"])
                {
                    case "continent":
                      echo "<h4>Continent</h4>";
                    break;
                    
                    case "langues":
                      echo "<h4>Langues parlées</h4>";
                    break;

                    case "villes":
                      echo "<h4>Villes</h4>";
                    break;
                }
            }
            ?>
            <!-- La façon dont on veut voir les données -->
            <select class="form-control col-md-3" onchange="location = this.value">
                <option value="">Sélectionner...</option>
                <option value="index.php?data=continent">Continent</option>
                <option value="index.php?data=langues">Langues parlées</option>
                <option value="index.php?data=villes">Villes</option>
            </select>
        </center>
        <div class="container">
            <br>
            <div class="row">
                <?php
            if (isset($_REQUEST["data"]))
            {
                switch ($_REQUEST["data"])
                {
                    // Voir les données par continents
                    case "continent":
                        // Obtenir la liste des continents
                        $continent = "SELECT DISTINCT continent as result FROM country ORDER BY continent ASC";
                        $requete = toFetch($continent);
                        // Afficher la liste des continents
                        while ($response = $requete->fetch())
                        {
                            $continent = $response["result"];
                            // Obtenir le nombre de pays dans ce continent
                            $pays = "SELECT * FROM country WHERE continent = '$continent'";
                            $nbPays = toCount($pays);
                            $link = "view_countries.php?continent=$continent";
                        ?>
                <div class="col-sm-4">
                    <div class="card" style="width: 20rem; margin: 10px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $continent ?></h5>
                            <h5><small><?php echo $nbPays ?> pays</small></h5>
                            <a href="<?php echo $link ?>" class="card-link">Voir les pays</a>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    break;
                    
                    // Voir les données par langues
                    case "langues":
                        // Obtenir la liste des langues parlées dans le monde
                        $language = "SELECT name as result FROM language ORDER BY name ASC";
                        $requete = toFetch($language);
                        // Afficher la liste des langues
                        while ($response = $requete->fetch())
                        {
                            $langue = $response["result"];
                            // Obtenir l'id de la langue
                            $idLangueQuery = requete("SELECT id FROM language WHERE name = '$langue'");
                            $idLangue = $idLangueQuery["id"];
                            // Obtenir le nombre de pays où la langue est parlée
                            $pays = "SELECT idCountry FROM countrylanguage WHERE idLanguage = $idLangue";
                            $nbPays = toCount($pays);
                            $link = "view_countries.php?langue=$idLangue";
                        ?>
                <div class="col-sm-4">
                    <div class="card" style="width: 20rem; margin: 10px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $langue ?></h5>
                            <h5><small><?php echo $nbPays ?> pays</small></h5>
                            <a href="<?php echo $link ?>" class="card-link">Voir les pays</a>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    break;

                    // Voir les données par villes
                    case "villes":
                        // Obtenir la liste des villes
                        $villes = "SELECT *  FROM city ORDER BY name";
                        $requete = toFetch($villes);
                        // Afficher la liste des villes
                        while ($response = $requete->fetch())
                        {
                            $nom = $response["Name"];
                            $district = $response["District"];
                            $population = $response["Population"];
                            $idPays = $response["idCountry"];
                        ?>
                <div class="col-sm-4">
                    <div class="card" style="width: 20rem; margin: 10px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $nom ?></h5>
                            <h6>District : <?php echo $district ?></h6>
                            <h5><small> Population :<?php echo $population ?></small></h5>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    break;
                }
            }
            ?>
            </div>
        </div>
    </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>