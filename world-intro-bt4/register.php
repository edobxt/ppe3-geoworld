<?php
    // Ajout du header
    require_once 'header.php';
    // Lien vers la connexion à la base de données des utilisateurs
    require_once 'inc/connect-db_users.php';

    // Script d'inscription
    if(isset($_POST['submit']))
    {
        // Initialisation des variables
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        if(isset($_POST['categorie']))
        {
            $idCategories = $_POST['categorie']; 
        }

        //Chiffrage du mot de passe 
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $mdp_confirm = password_hash($_POST['mdp_confirm'], PASSWORD_DEFAULT);

        //Vérification des champs
        if((!empty($nom)) && (!empty($prenom)) && (!empty($email)) && (!empty($idCategories)) && (!empty($mdp)) && (!empty($mdp_confirm))) 
        {

            //Vérification de l'email
            if (preg_match("!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!", $email))
            {
                if(isset($idCategories)){

                    //Verification du mot de passe 
                    if($_POST['mdp'] == $_POST['mdp_confirm'])
                    {
                        $database = connect_users();
                        $req = $database->prepare("INSERT INTO users(nom, prenom, email, mdp, idCategories) VALUES(?, ?, ?, ?, ?)");
                        $req->execute(array(
                            $nom,
                            $prenom,
                            $email,
                            $mdp,
                            $idCategories
                        ));
                        header('refresh:2; url=login.php');

                    } 
                    else {
                        $erreurMessage = "Your password isn't valid. Try again !";
                    }

                } else {
                    $erreurMessage = "";
                }

            } else {
                $erreurMessage = "Your mail isn't valid. Try again";
            }
        } else {
            $erreurMessage = "Please complete all fields !";
        }
        
    }
?>
<!-- Formulaire d'inscription -->
<body>
    <div class="container">
        <center>
            <div class="jumbotron">
                <h1>Register</h1>
                <br>
                <h2>
                    <?php
                        if(isset($erreurMessage))
                        {
                            echo '<p>' . $erreurMessage . '</p>';
                        }
                    ?>
                </h2>

                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="nom" placeholder="Your last name" />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="prenom" placeholder="Your first name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Your E-Mail">
                    </div>
                    <h3>Who are you ?</h3>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="categorie" value="2">
                        <label for="etudiant">Student</label><br>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="categorie" value="3">
                        <label for="professeur">Professor</label><br><br>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" name="mdp" placeholder="Enter your password" />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" name="mdp_confirm" placeholder="Confirm your password" />
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="submit" value="Validate" class="btn btn-primary">
                </form>
            </div>
        </center>
    </div>
</body>