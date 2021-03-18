<?php  
  // Ajout du header
  require_once 'header_student.php';
  // Lien vers les méthodes
  require_once 'inc/manager-db.php';
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
      <h1>Partie Élève</h1>
      <button type="button" class="btn btn-primary">See infos</button>
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
  </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>