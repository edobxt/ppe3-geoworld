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
        <h1>Créer vos requêtes ici</h1>
    </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>