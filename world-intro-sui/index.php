<?php require_once 'header.php'; ?>

<div class="ui container">
    <div>
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
          <select name="formContinent" class="ui search dropdown">
                <option value="">Select...</option>
                <option value="Asia">Asia</option>
                <option value="Europe">Europe</option>
                <option value="North America">North America</option>
                <option value="South America">South America</option>
                <option value="Africa">Africa</option>
                <option value="Oceania">Oceania</option>
                <option value="Antarctica">Antarctica</option>
                <input type="submit" name="submit" value="Select Continent" class="ui button"/>
              </select>
          </form>
      </center>
      <?php if($varContinent=="") {
        echo "<h1>Please select a continent</h1>";
      } else {
        echo "<h1>Countries in " . $varContinent . " : </h1>";
      } ?>
      
      <div class="continent-table">
          <?php
              require_once 'inc/manager-db.php';
              $continent = $varContinent;
              $desPays = getCountriesByContinent($continent);
          ?>
        <center>
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
        </center>
    </div>
    </div>
    <p></p>
</div>

<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>
