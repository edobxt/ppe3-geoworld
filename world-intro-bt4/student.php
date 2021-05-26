<?php  
    // Ajout du header
    require_once 'header.php';
    // Lien vers les méthodes
    require_once 'inc/manager-db.php';
?>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <center>
            <h1 style="color:#17A589;">Welcome to the Student's area</h1>
        </center>
        <br>
        <div class="row">
            <style>
                a {
                    color: #000;
                }
                a:hover {
                    color: #000;
                }
            </style>
            <div class="col-sm-6">
                <div class="card" style="width: 30rem; margin: 5px; height: 130px;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="index.php">Observe the data</a></h5>
                        <h5><small>Click to consult the geopolitical and economic data of the planet.</small></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card" style="width: 30rem; margin: 5px; height: 130px;">
                    <div class="card-body">
                        <h5 class="card-title">Test public queries</h5>
                        <h5><small>Not yet implemented.</small></h5>
                    </div>
                </div>
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