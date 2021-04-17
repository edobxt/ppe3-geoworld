<?php
    // Ajout du header
    require_once 'header.php';
    // Lien vers la connexion à la base de données des utilisateurs
    require_once 'inc/connect-db_users.php';

    // Script de connexion
    if(isset($_POST['submit']))
    {
        $email = htmlspecialchars($_POST['email']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        if((!empty($email)) && (!empty($mdp)))
        {
            $database = connect_users();
            //Récupération du mail et de son mdp hashé
            $req = $database->prepare("SELECT * FROM users WHERE email = ?");
            $req->execute(array(
                $email
            ));
            $resultat = $req->fetch();

            // Comparaison du pass envoyé via le formulaire avec la base
            $correct_mdp = password_verify($_POST['mdp'], $resultat->mdp);

            if(!$resultat)
            {
                $erreurMessage = 'Wrong mail or password !';
            }
            else 
            {
                // Si le mot de passe est correct
                if($correct_mdp)
                {
                    // Initialisation de la variable $_SESSION
                    session_start();
                    $_SESSION['idUsers'] = $resultat->idUsers;
                    $_SESSION['nom'] = $resultat->nom;
                    $_SESSION['prenom'] = $resultat->prenom;
                    $_SESSION['email'] = $resultat->email;
                    $_SESSION['mdp'] = $resultat->mdp;
                    $_SESSION['idCategories'] = $resultat->idCategories;

                    $idUsers = $_SESSION['idUsers']; 

                    $messageReussi = "You are connected !";
                    // Redirection vers la bonne partie en fonction de la catégorie après 2 secondes.
                    if(isset($_SESSION['email']))
                    {
                        if($_SESSION['idCategories'] == 2)
                        {
                            header('refresh:2; url=student.php?idUsers='.$idUsers);
                        }
                        else
                        {
                            header('refresh:2; url=professor.php?idUsers='.$idUsers);
                        }
                    }
                }
                else
                {
                    $erreurMessage = 'Wrong mail or password !';
                }
            }
        }
        else
        {
            $erreurMessage = "Please complete all fields !";
        }
    }
?>
<!-- Formulaire de connexion -->

<body>
    <div class="container">
        <center>
            <div class="jumbotron">
                <h1>Login</h1><br>

                <h2>
                    <?php 
                        // Affichage du message d'erreur
                        if(isset($erreurMessage))
                        {
                            echo '<p style="color:#FA2C07; font-size:15px;">' . $erreurMessage . '</p>';
                        }

                        if(isset($messageReussi))
                        {
                            echo '<p style="color:#0ECC4C; font-size:15px;">' . $messageReussi . '</p>';
                        }
                    ?>
                </h2>

                <form method="post">
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="email" placeholder="Mail" />
                    </div>
                    <div class="form-group col-md-5">
                        <input type="password" class="form-control" name="mdp" placeholder="Password" />
                    </div>

                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
                </form>
                <br>
                <h4>You don't have an account ? </h4> <a href="register.php">Click here</a>
            </div>
        </center>
    </div>
</body>