<?php
ini_set('display_errors', 1);
define('DB_NAME2', 'world_users');
define('DB_DSN2', 'mysql:host=localhost;dbname=' . DB_NAME2 . ';charset=utf8');
define('DB_USER2', 'geoworld');
define('DB_PASSWORD2', 'geoworldadmin');
define('DEBUG2', false);

$dbError = '';

function connect_users()
{
  global $dbError;
  $opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false
  );
  try {
    return new PDO(DB_DSN2, DB_USER2, DB_PASSWORD2, $opt);
  } catch (PDOException $e) {
    $dbError = 'Oups ! Connexion SGBD impossible !';
    if (DEBUG2) :
      $dbError .= "<br/>" . $e->getMessage();
    endif;
  }
}

// initialisation de la variable globale $pdo
global $pdo_users;
$pdo_users = connect_users();

if ($dbError) {
  die('<div class="ui red inverted segment"> <p>'
          . $dbError
          . '</p></div></body></html>');
}
