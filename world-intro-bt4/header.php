<?php 
    session_start();
    // Lien vers les méthodes
    require_once 'inc/manager-db.php';
    // Initialisation de la session

    // Récupération de la catégorie de l'utilisateur connecté
    if (isset($_SESSION['idCategories']))
    {
        $idCategorie = $_SESSION['idCategories'];
    }
?>
<!doctype html>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Homepage : Bootstrap 4</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.php">GeoWorld</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <!--<li class="nav-item active">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>-->
                    <?php 
                    header_page();
                    ?>
                    <li class="nav-item">
                        <a class="nav-link " href="todo-projet.php">
                            ProjetPPE-SLAM
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php
                    if (isset($_SESSION["idUsers"]))
                    {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="bi bi-box-arrow-right" style="font-size:16px; color:#fff;"></i>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>