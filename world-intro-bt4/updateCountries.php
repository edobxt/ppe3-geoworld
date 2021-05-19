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

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <!-- Bouton retour -->
        <a class="btn btn-secondary btn-sm" href="updateData.php">
            <i class="bi bi-arrow-bar-left">Retour</i></a>
        <!-- En tête -->
        <center>
            <?php 
                if(isset($_REQUEST["idCountry"]))
                {
                    $idCountry = $_REQUEST["idCountry"];
                    
                    $info_country = requete("SELECT * FROM country WHERE id = $idCountry");
                    $nom = $info_country["Name"];

                    echo "<h1>".$nom."</h1>";
                }
            ?>
        </center>
        <br>
        <!--
            Formulaire pour modifier les données
            - Certaines données ne seront pas modifiables
            - Bouton pour valider
        -->
        <form method="post">
            <table class="table table-bordered">
                <tr>
                    <th>Region</th>
                    <td><?php echo $info_country["Region"] ?></td>
                </tr>
                <tr>
                    <th>SurfaceArea</th>
                    <td><input type="text" name="" class="form-control"
                            value="<?php echo $info_country["SurfaceArea"]; ?>"></td>
                </tr>
                <tr>
                    <th>IndepYear</th>
                    <td><?php echo $info_country["IndepYear"]; ?></td>
                </tr>
                <tr>
                    <th>Population</th>
                    <td><input type="text" name="" class="form-control"
                            value="<?php echo $info_country["Population"]; ?>"></td>
                </tr>
                <tr>
                    <th>LifeExpectancy</th>
                    <td><input type="text" name="" class="form-control"
                            value="<?php echo $info_country["LifeExpectancy"]; ?>"></td>
                </tr>
                <tr>
                    <th>GNP</th>
                    <td><input type="text" name="" class="form-control" value="<?php echo $info_country["GNP"]; ?>">
                    </td>
                </tr>
                <tr>
                    <th>LocalName</th>
                    <td><?php echo $info_country['LocalName']; ?></td>
                </tr>
                <tr>
                    <th>GovernmentForm</th>
                    <td><input type="text" name="" class="form-control"
                            value="<?php echo $info_country["GovernmentForm"]; ?>"></td>
                </tr>
                <tr>
                    <th>HeadOfState</th>
                    <td><input type="text" name="" class="form-control"
                            value="<?php echo $info_country["HeadOfState"]; ?>"></td>
                </tr>
            </table>

            <input type="submit" name="submit" value="Mettre à jour" class="btn btn-primary">
        </form>
    </div>
</main>


<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>