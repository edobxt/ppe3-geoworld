<?php  
  // Ajout du header
  require_once 'header.php';
  // Lien vers les méthodes
  require_once 'inc/manager-db.php';
  // Initialisation de la session
  session_start(); 
?>

<div class="container"> 
    <?php
        //$continent = $varContinent;
        //$desVilles = getAllCity();

        // Récupération de l'identifiant du pays
        if (isset($_GET['idCountry']))
        {
            $idPays = $_GET['idCountry']; 
        }
        // Récupération du nom du pays
        if (isset($_GET['Name']))
        {
            $nom = $_GET['Name'];
        }
        // Recherche des villes par pays
        $desVilles = getCitiesByCountry($idPays);
        //var_dump($desVilles);
    ?>
    <h1>Cities in <?php echo $nom; ?></h1>
    
    <!-- Tableau contenant les informations -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Boucle affichant les informations
                for ($i = 0; $i < count($desVilles); $i++)
                {
                    echo "<tr>";

                    echo "<td>" . $desVilles[$i]->Name . "</td>";
                    echo "<td>" . $desVilles[$i]->District . "</td>";
                    echo "<td>" . $desVilles[$i]->Population . "</td>";

                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>