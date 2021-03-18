<?php  
  // Ajout du header
  require_once 'header_prof.php';
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
      <h1>Welcome to your Professor Space.</h1>
      <button type="button" class="btn btn-primary btn-lg">See infos</button>
    </center>
    <br>
    <div class="row">
      <!-- Lien vers la création de requête -->
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create a query</h5>
            <p class="card-text">Create and test SQL queries.</p>
            <a href="make_query.php" class="btn btn-primary">Create</a>
          </div>
        </div>
      </div>
      <!-- Lien vers la gestion des requêtes -->
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage queries</h5>
            <p class="card-text">Manage your SQL queries.</p>
            <a href="#" class="btn btn-primary">Manage</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <!-- Liste des requêtes créées par le professeur -->
    <h2>Dernières requêtes effectuées</h2>
    <?php 
    $SQLParam = "select * from requetes where idUsers = $idUsers";
    $MyResult = $pdo->query($SQLParam);
    $MyResult->setFetchMode(PDO::FETCH_ASSOC);
    ?>
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
        <?php
        // TODO Affichage des requêtes publiques
        while($AllResponse = $MyResult->fetch())
        {
        ?>
        <tr>
          <th scope="row"><? echo 1; ?></th>
          <td><? echo $AllResponse["libelle"]; ?></td>
          <td><? echo $AllResponse["requete"]; ?></td>
          <td><? echo $AllResponse["visibilite"]; ?></td>
          <td>TODO</td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>