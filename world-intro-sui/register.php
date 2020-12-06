<?php
    require_once 'header.php';

    if(isset($_POST['submit'])){
        
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $mdp_confirm = password_hash($_POST['mdp_confirm'], PASSWORD_DEFAULT);
    }
?>

<body>
    <div class="container">
        <h1>Register</h1>
        <form method="post">
            <input type="text" name="nom" placeholder="Name" />
            <input type="text" name="prenom" placeholder="First Name" /></br>
            <input type="email" name="email" placeholder="Mail"></br>
            <label for="etudiant">Who are you ?</label><br>
            <input type="radio" name="categorie" value="Student">
            <label for="etudiant"> a student</label><br>
            <input type="radio" name="categorie" value="Profesor">
            <label for="professeur">a professor</label><br>
            <input type="password" name="mdp" placeholder="Password" /></br>
            <input type="password" name="mdp_confirm" 
                placeholder="Confirm password" /></br>
            <input type="submit" value="Next">
        </form>
        
    </div>

</body>