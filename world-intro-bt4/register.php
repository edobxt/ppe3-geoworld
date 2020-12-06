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
            $categorie = $_POST['categorie']; 
        }

        //Chiffrage du mot de passe 
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $mdp_confirm = password_hash($_POST['mdp_confirm'], PASSWORD_DEFAULT);

        //Vérification des champs
        if((!empty($nom)) && (!empty($prenom)) && (!empty($email)) && (!empty($categorie)) && (!empty($mdp)) && (!empty($mdp_confirm))) 
        {

            //Vérification de l'email
            if (preg_match("!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!", $email))
            {
                if(isset($categorie)){

                    //Verification du mot de passe 
                    if($_POST['mdp'] == $_POST['mdp_confirm'])
                    {
                        $database = connect_users();
                        $req = $database->prepare("INSERT INTO users(nom, prenom, email, mdp, categorie) VALUES(?, ?, ?, ?, ?)");
                        $req->execute(array(
                            $nom,
                            $prenom,
                            $email,
                            $mdp,
                            $categorie
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
                    <input type="text" name="nom" placeholder="Your last name" />

                    <input type="text" name="prenom" placeholder="Your first name" /></br><br>

                    <input type="email" name="email" placeholder="Your E-Mail"></br><br>

                    <label for="etudiant">Who are you ?</label><br>
                    <input type="radio" name="categorie" value="Student">
                    <label for="etudiant"> a student</label><br>

                    <input type="radio" name="categorie" value="Profesor">
                    <label for="professeur">a professor</label><br><br>

                    <input type="password" name="mdp" placeholder="Enter your password" /></br><br>

                    <input type="password" name="mdp_confirm" 
                        placeholder="Confirm your password" /></br><br>

                    <input type="submit" name="submit" value="Next" class="btn btn-primary">
                </form>
            </div>
        </center>
    </div>
</body>