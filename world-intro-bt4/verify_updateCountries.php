<?php
    // Lien vers les méthodes
    require_once 'inc/connect-db.php';
    require_once 'inc/manager-db.php';
    // Initialisation de la session
    session_start();
    
    if (isset($_SESSION["idUsers"]))
    {
        $idUsers = $_SESSION["idUsers"];
    }

    if(isset($_REQUEST["idCountry"]))
    {
        $idCountry = $_REQUEST["idCountry"];
        //echo $idCountry."<br>";
    }
    
    if(isset($_POST["surfaceArea"]))
    {
        $surfaceArea = $_POST["surfaceArea"];
        //echo $surfaceArea."<br>";
    }

    if(isset($_POST["population"]))
    {
        $population = $_POST["population"];
        //echo $population."<br>";
    }

    if(isset($_POST["lifeExpectancy"]))
    {
        $lifeExpectancy = $_POST["lifeExpectancy"];
        //echo $lifeExpectancy."<br>";
    }

    if(isset($_POST["GNP"]))
    {
        $GNP = $_POST["GNP"];
        //echo $GNP."<br>";
    }

    if(isset($_POST["governmentForm"]))
    {
        $governmentForm = $_POST["governmentForm"];
        //echo $governmentForm."<br>";
    }

    if(isset($_POST["HOS"]))
    {
        $HOS = $_POST["HOS"];
        //echo $HOS."<br>";
    }

    $sql_updateCountries = "update country"
    ." set SurfaceArea = $surfaceArea, Population = $population, LifeExpectancy = $lifeExpectancy,"
    ." GNP = $GNP, GovernmentForm = '$governmentForm', HeadOfState = '$HOS'"
    ." where id = $idCountry";
    //echo $sql_updateCountries;
    $response = $pdo->exec($sql_updateCountries);

    header("Location:updateCountries.php?idCountry=$idCountry");



?>