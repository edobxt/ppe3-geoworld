<?php
 require_once 'connect-db.php';
 //require_once 'connect-db_users.php';
 
 /** Obtenir la liste de tous les pays référencés d'un continent donné
  * @param $continent le nom d'un continent
  * @return tableau d'objets (des pays)
  */
   function getCountriesByContinent($continent)
   {
      // pour utiliser la variable globale dans la fonction
      global $pdo;
      $query = 'SELECT * FROM Country WHERE Continent = :continent;';
      $prep = $pdo->prepare($query);
      $prep->bindValue(':continent', $continent, PDO::PARAM_STR);
      $prep->execute();
      // var_dump($prep);
      // var_dump($continent);
      return $prep->fetchAll();
   }
 
 /** Obtenir la liste des pays
  * @return liste d'objets
  */
   function getAllCountries()
   {
      global $pdo;
      $query = 'SELECT * FROM Country;';
      return $pdo->query($query)->fetchAll();
   }

/** Obtenir la liste des pays
  * @return liste d'objets
  */
  function getAllCity()
  {
      global $pdo;
      $query = 'SELECT * FROM City;';
      return $pdo->query($query)->fetchAll();
  }

 /** Obtenir la liste de toutes les villes référencés d'un pays donné
  * @param $pays id d'un pays
  * @return tableau d'objets (des villes)
 */
  function getCitiesByCountry($idPays)
  {
     global $pdo;
     $query = 'SELECT * FROM City WHERE idCountry = :idCountry;';
     $prep = $pdo->prepare($query);
     $prep->bindValue(':idCountry', $idPays, PDO::PARAM_STR);
     $prep->execute();
     return $prep->fetchAll();
  }

  /**
 * Fonction permettant d'effectuer des requêtes plus simplement
*/
function requete($requete)
{
    global $pdo;

    // Définition du type de requête
    $def_type = explode(" ", $requete);
    $type_req = $def_type[0];
    // Si c'est une SELECT
    if ($type_req == "SELECT")
    {
        $Myresult = $pdo->query($requete);
        $Myresult->setFetchMode(PDO::FETCH_ASSOC);
        $response = $Myresult->fetch();

        return $response;
    }
    // Si c'est autre chose qu'une SELECT
    else {
        $response = $pdo->exec($requete);
    }
}

/**
 * Fonction qui retourne le résultat d'une requête à fetch pour une boucle
    */
function toFetch($requete)
{
    global $pdo;

    $Myresult = $pdo->query($requete);
    $Myresult->setFetchMode(PDO::FETCH_ASSOC);
    return $Myresult;
}
/**
 * Fonction qui retourne le nombre de résultat d'une requête
    */
function toCount($requete)
{
    global $pdo;

    $Myresult = toFetch($requete);
    $nb_result = $Myresult->rowCount();
    return $nb_result;
}

/**
 * Fonction retournant un tableau ldes colonnes d'une table de la base de données
 */
function getAllColumns($requete)
{
    global $pdo;

    // Découper la requête à partir de FROM
    $part1 = explode("FROM", $requete);
    // Découper encore la requête afin d'obtenir le nom de la table
    $part2 = explode(" ", $part1["1"]);
    // Récupérer le nom de la table
    $table = $part2["1"];

    // Récupérer les colonnes de la table
    $q = $pdo->prepare("DESCRIBE $table");
    $q->execute();
    $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

    return $table_fields;
}
?>