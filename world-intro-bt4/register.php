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
                    //Liste de tous les messages d'erreurs
                    else {
                        $erreurMessage = "Your password isn't correct. Try again!";
                    }

                } else {
                    $erreurMessage = "Tell me who you are.";
                }

            } else {
                $erreurMessage = "Your email isn't valid. Try again!";
            }
        } else {
            $erreurMessage = "Fill all the fields please.";
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
                        //Afficher le message d'erreur
                        if(isset($erreurMessage))
                        {
                            echo '<p>' . $erreurMessage . '</p>';
                        }
                    ?>
                </h2>
                <!-- Formulaire -->
                <form method="post">

                    <!-- Nom / Prénom -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="nom" placeholder="Last name" required />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="prenom" placeholder="First name" required />
                        </div>
                    </div>

                    <!-- Adresse mail -->
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>

                    <!-- Identifier quel type de personne qui s'inscrit (un professeur ou un élève) -->
                    <h4>Who are you?</h4>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="categorie" value="2">
                        <label for="etudiant">Student</label><br>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="categorie" value="3">
                        <label for="professeur">Teacher</label><br><br>
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" name="mdp" placeholder="Password" required />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" name="mdp_confirm"
                                placeholder="Confirm the password" required />
                        </div>
                    </div>
                    <br>

                    <!-- Bouton pour valider le formulaire -->
                    <input type="submit" name="submit" value="Validate" class="btn btn-primary">
                </form>
            </div>
        </center>
    </div>
</body>