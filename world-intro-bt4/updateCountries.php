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

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <!-- Bouton retour -->
        <a class="btn btn-secondary btn" href="updateData.php"><i class="bi bi-arrow-bar-left"></i> Retour</a>
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
        <form action="verify_updateCountries.php?idCountry=<?php echo $idCountry ?>" method="post">
            <table class="table table-bordered">
                <tr>
                    <th>Local Name</th>
                    <td><?php echo $info_country['LocalName']; ?></td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td><?php echo $info_country["Region"] ?></td>
                </tr>
                <tr>
                    <th>Surface Area</th>
                    <td><input type="text" name="surfaceArea" class="form-control"
                            value="<?php echo $info_country["SurfaceArea"]; ?>"></td>
                </tr>
                <tr>
                    <th>Population</th>
                    <td><input type="text" name="population" class="form-control"
                            value="<?php echo $info_country["Population"]; ?>"></td>
                </tr>
                <tr>
                    <th>Life Expectancy</th>
                    <td><input type="text" name="lifeExpectancy" class="form-control"
                            value="<?php echo $info_country["LifeExpectancy"]; ?>"></td>
                </tr>
                <tr>
                    <th>GNP</th>
                    <td><input type="text" name="GNP" class="form-control" value="<?php echo $info_country["GNP"]; ?>">
                    </td>
                </tr>
                <tr>
                    <th>Government Form</th>
                    <td><input type="text" name="governmentForm" class="form-control"
                            value="<?php echo $info_country["GovernmentForm"]; ?>"></td>
                </tr>
                <tr>
                    <th>Head Of State</th>
                    <td><input type="text" name="HOS" class="form-control"
                            value="<?php echo $info_country["HeadOfState"]; ?>"></td>
                </tr>
            </table>
            <input type="hidden" name="idCountry" value="<?php echo $idCountry ?>">
            <input type="submit" name="submit" value="Mettre à jour" class="btn btn-primary" id='notifier-btn'>
        </form>
        <script>
        document.getElementById("notifier-btn").onclick = notifier;

        /* Quand le document sera chargé */
        document.addEventListener('DOMContentLoaded', function() {

            /* Vérifie si le navigateur est compatible avec les notifications */
            if (!Notification) {
                alert('Le navigateur ne supporte pas les notifications.');
            }
            /* Si le navigateur prend en charge les notifications,
            on demande la permission si les notifications ne sont pas permises */
            else if (Notification.permission !== 'granted')
                Notification.requestPermission();
        });


        function notifier() {
            /* On demande la permission si les notifications ne sont pas permises */
            if (Notification.permission !== 'granted')
                Notification.requestPermission();
            else {

                // Affichage du message
                var notification = new Notification('Geoworld', {
                    body: 'La mise à jour a bien été effectué',
                    //image: "",
                });

                // Redirection vers la page avec la liste des pays
                notification.onclick = function() {
                    window.open("updateData.php");

                };

                // Disparition de la notification au bout de 5 sec
                notification.onshow = function() {
                    setTimeout(notification.close.bind(notification), 5000);
                }

            }
        }
        </script>
    </div>
</main>


<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>