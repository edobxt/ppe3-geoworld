<?php  
  // Ajout du header
  require_once 'header.php';
  // Lien vers les méthodes
  require_once 'inc/manager-db.php';
  // Initialisation de la session
  session_start(); 
?>

<main role="main" class="flex-shrink-0">

  <div class="container">
    <?php 
    $varContinent="";
    if(isset($_POST['submit']))
    {
      $varContinent = $_POST['formContinent'];
    }
    ?>

    <center>
      <h2>Select a continent</h2>
      <form method="POST" class="dropdown">
        <div class="col">
          <select name="formContinent" class="form-control">
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
        if(isset($_SESSION['idUsers']))
        {
          echo '<h3>Connect as ' . $_SESSION['nom'] . " " . $_SESSION['prenom'] . ".</h3>";
        }
        
        if($varContinent=="") 
        {
          echo "<h1>Please select a continent</h1>";
        } 
        else 
        {
          echo "<h1>Countries in " . $varContinent . " : </h1>";
        } 
     ?>
    
    <div class="continent-table">
        <?php
            $continent = $varContinent;
            $desPays = getCountriesByContinent($continent);
         ?>
       <div>
         <style>
           table, th, td {
             border: 1px solid black;
             border-collapse: collapse;
           }
           th, td {
             padding: 5px;
             text-align: left;
           }
         </style>

         <table>
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

           <?php
             for ($i = 0; $i < count($desPays); $i++) {
              echo "<tr>";

              echo "<td>" . $desPays[$i]->Name . "</td>";
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
           ?>
         </table>
      </div>
    </div>
    <p></p>
  </div>
</main>

<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>
