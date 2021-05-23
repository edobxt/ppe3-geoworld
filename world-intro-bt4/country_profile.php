<?php  
    // Ajout du header
    require_once 'header.php';
    // Lien vers les méthodes
    require_once 'inc/manager-db.php';
    // Initialisation de la session
    session_start(); 

    // Récupérer l'id du pays
    if (isset($_REQUEST["idCountry"]))
    {
        $idPays = $_REQUEST["idCountry"];
    }

    // Récupérer les informations du pays
    $pays = "SELECT * FROM country WHERE id = $idPays";
    $infoPays = requete($pays);
    
    // Récupérer les colonnes de la table pays
    $q = $pdo->prepare("DESCRIBE country");
    $q->execute();
    $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
    //var_dump($table_fields);

    $def = explode("FROM", $pays);
    //var_dump($def);
    $defe = explode(" ", $def["1"]);
    var_dump($defe);
?>

<style>
    body {
        overflow-y: scroll;
    }
</style>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <center>
            <!--<?php
            // Récupérer le code pour le drapeau
            $codePaysImage = strtolower($infoPays["Code2"]);
            ?>
            <img src="images/drapeau/<?php echo $codePaysImage ?>.jpg" alt="imagePays">-->
            <h1><?php echo $infoPays["Name"] ?></h1>
        </center>
        <br>
        <div class="container">
            
        </div>
        
    </div>
</main>
<?php
    // Ajout de script Javascript
    require_once 'javascripts.php';
    // Ajout du footer
    require_once 'footer.php';
?>