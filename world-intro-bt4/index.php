<?php  
  // Ajout du header
  require_once 'header.php';
  // Lien vers les méthodes
  require_once 'inc/manager-db.php';
  // Initialisation de la session
  session_start(); 
?>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <center>
            <h2>Voir les données par :</h2>
            <?php
            if (isset($_REQUEST["data"]))
            {
                switch ($_REQUEST["data"])
                {
                    case "continent":
                      echo "<h3>Continent</h3>";
                    break;
                    
                    case "langues":
                      echo "<h3>Langues parlées</h3>";
                    break;
                }
            }
            ?>
            <br>
            <!-- La façon dont on veut voir les données -->
            <select class="form-control col-md-3" onchange="location = this.value">
                <option value="">Sélectionner...</option>
                <option value="index.php?data=continent">Continent</option>
                <option value="index.php?data=langues">Langues parlées</option>
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
                    case "continent":
                        $continent = "SELECT DISTINCT continent as result FROM country ORDER BY continent ASC";
                        $requete = toFetch($continent);
                    break;

                    case "langues":
                        $language = "SELECT name as result FROM language ORDER BY name ASC";
                        $requete = toFetch($language);
                    break;
                }
                
                while ($response = $requete->fetch())
                {
            ?>
                <div class="col-sm-4">
                    <div class="card" style="width: 20rem; margin: 10px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $response["result"]  ?></h5>
                            <?php
                            switch ($_REQUEST["data"])
                            {
                                // Nombre de pays pour ce continent
                                case "continent":
                                    $continent = $response["result"];
                                    $pays = "SELECT * FROM country WHERE continent = '$continent'";
                                    $nbPays = toCount($pays);
                                break;
                                
                                // Nombre de pays ayant cette langue comme officielle
                                case "langues":
                                    $langue = $response["result"];
                                    $idLangueQuery = requete("SELECT id FROM language WHERE name = '$langue'");
                                    $idLangue = $idLangueQuery["id"];
                                    $pays = "SELECT idCountry FROM countrylanguage WHERE idLanguage = $idLangue";
                                    $nbPays = toCount($pays);
                                break;
                            }
                            ?>
                            <h5><small><?php echo $nbPays  ?> pays</small></h5>
                            <a href="#" class="card-link">Voir les pays</a>
                        </div>
                    </div>
                </div>
            <?php
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