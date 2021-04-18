<?php  
  // Ajout du header
  require_once 'header_prof.php';
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
<div class="row">
    <div class="col-sm-3">
        <div class="col">
            <select name="formContinent" class="form-control" onchange="location = this.value">
                <option value="">Select...</option>
                <option value="updateData.php?Continent=Asia">Asia</option>
                <option value="updateData.php?Continent=Europe">Europe</option>
                <option value="updateData.php?Continent=North America">North America</option>
                <option value="updateData.php?Continent=South America">South America</option>
                <option value="updateData.php?Continent=Africa">Africa</option>
                <option value="updateData.php?Continent=Oceania">Oceania</option>
                <option value="updateData.php?Continent=Antarctica">Antarctica</option>
            </select>
        </div>
        </br>
    </div>
    <div class="col-sm-8">
        <?php
            if(isset($_REQUEST["Continent"]))
            {
                $continent = $_REQUEST["Continent"];
                
                $data_pays = toFetch("SELECT * FROM country WHERE continent = '$continent'");
            
        ?>
        <?php echo " <h1>Country in ".$continent."</h1>" ?>
        <div class="row">
            <?php
                while ($response = $data_pays->fetch())
                {
            ?>
            <div class="col-sm-4">
                <div class="card" style="width: 15rem; margin:10px; text-align:center;">
                    <div class="card-body">
                        <?php echo $response["Name"] ?>
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