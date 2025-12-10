<?php
include "connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if(mysqli_query($conn, $sql)){
        header("Location: login.php");
        exit();
    }
    else{
        echo "ERROR:" . mysqli_error($connect);
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/styles/signup.css"> 
    <link rel="icon" type="image/jpeg" href="/images/Solvd Inc_ · Walnut Creek, California.jpeg" />
</head>
<body>
    <div class="main-container">
        <main class="dashboard-content">
            <div class="form-card signup-card">
                <h3 class="card-title">Inscription</h3>
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="text" id="signup-username" name="username" placeholder="Nom d'utilisateur" required>
                    </div>
                    <div class="input-group">
                        <input type="email" id="signup-email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group password-group">
                        <input type="password" id="signup-password" name="password" placeholder="Mot de passe" required>
                        <span class="password-toggle">👁️</span>
                    </div>

                    <button type="submit" class="btn-register">S'inscrire</button>
                    
                    <div class="form-footer">
                        <p>
                            Déjà un compte ? 
                            <a href="/login.php" class="connect-now">Connectez-vous</a>
                        </p>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>