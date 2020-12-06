<?php
    require_once 'header.php';
?>

<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="email" placeholder="Mail" /></br>
            <input type="password" name="mdp" placeholder="Password" /></br>
            <input type="submit" value="Login">
        </form>
        <h3>Vous n'avez pas de compte ? </h3><a href="register.php">Cliquez ici</a>
    </div>

</body>