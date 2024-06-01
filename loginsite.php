<!DOCTYPE html>

<?php
    //error_reporting(E_ERROR | E_PARSE);
    session_start();

    if(isset($_SESSION['islogged'])){
        if(!($_SESSION['name'] == "sperdax" OR $_SESSION['name'] == "pezzox")){
            header("Location: user_homepage.php");
        }else{
            header("Location: admin_homepage.php");
        }
    }
    

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eGaming</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sitename-container">
        <h1>eGaming</h1>
    </div>
    <div class="main-container">
        <input type="checkbox" id="check" aria-hidden="true">
        <div class="register-container">
            <form action="registrazione.php" method="post">
                <label for="check" aria-hidden="true">Registrati</label>
                <input type="text" name="name" placeholder="Nome" required>
                <input type="text" name="surname" placeholder="Cognome" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required pattern=(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} title="La password deve essere lunga almeno 8 caratteri e deve contenere almeno un numero, una lettera maiuscola e una lettera minuscola.">
                <button type="submit">Registrati</button>
            </form>
        </div>
        <div class="login-container">
            <form action="login.php" method="post">
                <label for="check" aria-hidden="true">Login</label>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>