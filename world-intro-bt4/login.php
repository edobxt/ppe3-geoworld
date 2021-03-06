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

        //Verification des champs
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
                $erreurMessage = 'Adresse mail ou mot de passe incorrect. Réessayer!';
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

                    $messageReussi = "You are connected.";
                    // Redirection vers la bonne partie en fonction de la catégorie après 2 secondes.
                    if(isset($_SESSION['email']))
                    {
                        if($_SESSION['idCategories'] == 2)
                        {
                            header("Location: student.php");
                        }
                        else
                        {
                            header("Location: professor.php");
                        }
                    }
                }
                else
                {
                    $erreurMessage = 'Email or password incorrect, Try again !';
                }
            }
        }
        else
        {
            $erreurMessage = "Fill all the fields please.";
        }
    }
?>
<!-- Formulaire de connexion -->

<body>
    <div class="container">
        <center>
            <div class="jumbotron">
                <!--<i class="bi bi-person-circle" style="font-size:30px;"></i>-->
                <h1>Log in</h1><br>

                <h2>
                    <?php 
                        // Affichage du message d'erreur ou réussite
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
                        <input type="email" class="form-control" name="email" placeholder="Email" required />
                    </div>
                    <div class="form-group col-md-5">
                        <input type="password" class="form-control" name="mdp" placeholder="Password" required />
                    </div>

                    <input type="submit" name="submit" value="Connection" class="btn btn-primary">
                </form>
                <br>
                <h4>Don't have an account?</h4> <a href="register.php">Click here.</a>
            </div>
        </center>
    </div>
</body>