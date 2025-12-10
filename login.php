<?php
include "connect.php";
session_start();

$errormsg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sqluser = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $results = mysqli_query($conn, $sqluser);

    if(mysqli_num_rows($results) == 1){

        $row = mysqli_fetch_assoc($results);
        $_SESSION["username"] = $row['username'];
        $_SESSION['id_user'] = $row['id_user'];
        header("Location: dashboard.php");
        exit();
    }
    else{
        $errormsg = "Nom d'utilisateur ou mot de passe incorrect !";
    }

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/styles/login.css">
    <link rel="icon" type="image/jpeg" href="/images/Solvd Inc_ · Walnut Creek, California.jpeg" />

</head>
<body>
    <div class="main-container">
        <main class="dashboard-content">
            <h2 class="dashboard-title">Bienvenue</h2>

            <?php if(!empty($errormsg)): ?>
                <div class="msg-error"><?= $errormsg ?></div>
            <?php endif; ?>

            <div class="form-card login-card">
                <h3 class="card-title">Connexion</h3>
                <form action="" method="POST">
                    <div class="input-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                    </div>
                    <div class="input-group password-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                        <span class="password-toggle">👁️</span>
                    </div>

                    <button type="submit" class="btn-connect">Se connecter</button>
                    
                    <div class="form-footer">
                        <p>
                            <a href="/index.php" class="create-account">Créer un compte</a>
                        </p>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>