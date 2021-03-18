<?php  
  // Ajout du header
  require_once 'header.php';
  // Lien vers les méthodes
  require_once 'inc/manager-db.php';
  // Initialisation de la session
  session_start(); 
?>

<main role="main" class="flex-shrink-0">

  <div class="container-fluid">
    <?php 
      // Initialisation de la variable $varContinent
      $varContinent="";
      // Récupération de la valeur de l'input dans la variable $varContinent
      if(isset($_POST['submit']))
      {
        $varContinent = $_POST['formContinent'];
      }
      // Informations sur qui est connecté
      if(isset($_SESSION['idUsers']))
      {
        //echo '<h5>Connect as ' . $_SESSION['nom'] . " " . $_SESSION['prenom'] . ".</h5>";
      }
    ?>

    <center>
      <!--<h2>Select a continent</h2>-->
      <!-- Menu Select permettant de choisir les continents -->
      <form method="POST" class="dropdown">
        <div class="col">
          <select name="formContinent" class="form-control col-md-3">
            <option value="">Select...</option>
            <option value="Asia">Asia</option>
            <option value="Europe">Europe</option>
            <option value="North America">North America</option>
            <option value="South America">South America</option>
            <option value="Africa">Africa</option>
            <option value="Oceania">Oceania</option>
            <option value="Antarctica">Antarctica</option>
          </select>
        </div>
        </br>
        <input type="submit" name="submit" value="Select Continent" class="btn btn-light" />
      </form>
    </center>

    <?php 
        // Affichage du continent choisi
        if($varContinent=="") 
        {
          echo "<br><center><h1>Select a continent to see his countries.</h1></center>";
        } 
        else 
        {
          echo "<h1>Countries in " . $varContinent . " : </h1>";
         
      ?>

    <div class="continent-table">
      <?php
        // Recherche des pays du continent choisit
        $continent = $varContinent;
        $desPays = getCountriesByContinent($continent);
      ?>

      <!-- Tableau contenant les informations -->
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Name</th>
            <th>Region</th>
            <th>SurfaceArea</th>
            <th>IndepYear</th>
            <th>Population</th>
            <th>LifeExpectancy</th>
            <th>GNP</th>
            <th>GNPOld</th>
            <th>LocalName</th>
            <th>GovernmentForm</th>
            <th>HeadOfState</th>
          </tr>
        </thead>
        <tbody>
          <?php
              
              // Boucle affichant les informations
              for ($i = 0; $i < count($desPays); $i++) 
              {
                echo "<tr>";

                echo "<td><a href='view_city.php?idCountry=" . $desPays[$i]->id . "&Name=" . $desPays[$i]->Name 
                . "'target='_blank' class='text-primary'>" . $desPays[$i]->Name . "</a></td>";
                echo "<td>" . $desPays[$i]->Region . "</td>";
                echo "<td>" . $desPays[$i]->SurfaceArea . "</td>";
                echo "<td>" . $desPays[$i]->IndepYear . "</td>";
                echo "<td>" . $desPays[$i]->Population . "</td>";
                echo "<td>" . $desPays[$i]->LifeExpectancy . "</td>";
                echo "<td>" . $desPays[$i]->GNP . "</td>";
                echo "<td>" . $desPays[$i]->GNPOld . "</td>";
                echo "<td>" . $desPays[$i]->LocalName . "</td>";
                echo "<td>" . $desPays[$i]->GovernmentForm . "</td>";
                echo "<td>" . $desPays[$i]->HeadOfState . "</td>";
                
                echo "</tr>";
              }
              }
            ?>
        </tbody>
      </table>
    </div>
    <p></p>
  </div>
</main>

<?php
  // Ajout de script Javascript
  require_once 'javascripts.php';
  // Ajout du footer
  require_once 'footer.php';
?>