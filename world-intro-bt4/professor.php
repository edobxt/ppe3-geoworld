<?php  
  // Ajout du header
  header_page(1);
  // Lien vers les méthodes
  require_once 'inc/connect-db_users.php';
  // Initialisation de la session
  session_start();
  
  if (isset($_REQUEST["idUsers"]))
  {
    $idUsers = $_REQUEST["idUsers"];
  }
?>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <!-- Entête -->
        <center>
            <h1>Welcome to the Teacher's area</h1>
        </center>
        <br>
        <div class="row">
            <!--  -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update</h5>
                        <p class="card-text">Update the geographic data of countries manually</p>
                        <a href="updateData.php" class="btn btn-primary">
                            Click here</a>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Supprimer</h5>
                        <p class="card-text">...</p>
                        <a href="#" class="btn btn-primary">Supprimer</a>
                    </div>
                </div>
            </div>
            -->
        </div>
        <br>
        <!-- Liste des requêtes créées par le professeur 
        <h2>Dernières requêtes effectuées</h2>
        
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Requête</th>
                    <th scope="col">Visibilité</th>
                    <th scope="col">Éditer</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        -->
    </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>