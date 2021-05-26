<?php  
  // Ajout du header
  header_page(1);
  // Lien vers les méthodes
  require_once 'inc/connect-db.php';
  require_once 'inc/manager-db.php';
  // Initialisation de la session
  session_start();
  
  if (isset($_SESSION["idUsers"]))
  {
    $idUsers = $_SESSION["idUsers"];
  }
?>

<!-- Sélectionner un continent -->
<div class="row">
    <div class="col-sm-3">
        <div class="col">
            <!-- Bouton retour -->
            <a class="btn btn-secondary btn" href="professor.php?idUsers=<?php echo $idUsers;?>"><i
                    class="bi bi-arrow-bar-left"></i> Return</a>
            <br><br>

            <br>
        </div>

        </br>
    </div>
    <div class="col-sm-8">
        <center>
            <!-- Selectionner un continent -->
            <select name="formContinent" class="form-control" onchange="location = this.value">
                <option value="">Select a continent</option>
                <option value="updateData.php?Continent=Asia">Asia</option>
                <option value="updateData.php?Continent=Europe">Europe</option>
                <option value="updateData.php?Continent=North America">North America</option>
                <option value="updateData.php?Continent=South America">South America</option>
                <option value="updateData.php?Continent=Africa">Africa</option>
                <option value="updateData.php?Continent=Oceania">Oceania</option>
                <option value="updateData.php?Continent=Antarctica">Antarctica</option>
            </select>
        </center>
        <?php
        //Afficher tous les pays du continent sélectionné
            if(isset($_REQUEST["Continent"]))
            {
                $continent = $_REQUEST["Continent"];
                
                $data_pays = toFetch("SELECT * FROM country WHERE continent = '$continent'");
            
        ?>

        <?php
            echo " <br><h1>Country in ".$continent."</h1>" 
        ?>

        <!-- Afficher les pays dans des cartouches -->
        <div class="row">
            <?php
                while ($response = $data_pays->fetch())
                {
                    $nom_pays = $response["Name"];
                    $id_pays = $response["id"];
            ?>
            <div class="col-sm-4">
                <!-- CSS des cartouches -->
                <style>
                a {
                    text-decoration: none;
                    color: #000;
                }

                .card:hover {
                    text-decoration: #0000;
                    background-color: #EBF5FB;
                }

                a:hover {
                    font-weight: bold;
                    text-decoration: none;
                }
                </style>

                <div class="card" style="width: 15rem; margin:10px; text-align:center;">
                    <!-- Lien pour modifier le pays -->
                    <div class="card-body">
                        <a href="updateCountries.php?idCountry=<?php echo $id_pays; ?>"><?php echo $nom_pays; ?></a>
                    </div>

                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <?php } ?>
    </div>

</div>


<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>