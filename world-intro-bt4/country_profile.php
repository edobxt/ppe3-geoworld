<?php  
    // Ajout du header
    require_once 'header.php';
    // Lien vers les méthodes
    require_once 'inc/manager-db.php';

    // Récupérer l'id du pays
    if (isset($_REQUEST["idCountry"]))
    {
        $idPays = $_REQUEST["idCountry"];
    }

    // Récupérer les informations du pays
    $pays = "SELECT * FROM country WHERE id = $idPays";
    $infoPays = requete($pays);
    
    // Récupérer les colonnes de la table pays
    $colonnesPays = getAllColumns($pays);
    //var_dump($colonnesPays);
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
            <h1 style="color:#17A589;">Infos of <?php echo $infoPays["Name"] ?></h1>
        </center>
        <br>
        <div class="container">
            <div class="row">
                <?php 
                // Supprimer les éléments indésirables du tableau
                unset($colonnesPays[0]); // id
                unset($colonnesPays[15]); // Code2
                // Affichage des informations du pays
                foreach ($colonnesPays as $colonne) {
                ?>
                    <div class="col-sm-4">
                        <div class="card" style="width: 20rem; margin: 10px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $colonne ?></h5>
                                <?php
                                // Switch en fonction de l'information à ajouter
                                switch ($colonne) {
                                    // Affichage par défaut
                                    default:
                                        $info = isset($infoPays["$colonne"]) ? $infoPays["$colonne"] : "N/A";                                        
                                    ?>
                                        <h5><small><?php echo $info ?></small></h5>
                                    <?php
                                    break;
                                    // Dans le cas de l'affichage de la capital
                                    case "Capital":
                                        // Récupérer la capital du pays
                                        $idCapital = $infoPays["Capital"];
                                        $capital = requete("SELECT Name FROM city WHERE id = $idCapital");
                                    ?>
                                        <h5><small><?php echo $capital["Name"] ?></small></h5>
                                    <?php
                                    break;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                } 
                ?>
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