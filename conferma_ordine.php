<!DOCTYPE html>
<html lang="en">

<?php
    //error_reporting(E_ERROR | E_PARSE);
    session_start();

    if($_SESSION['islogged'] == false){
        header("Location: loginsite.php");
    }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eGaming</title>
    <link rel="stylesheet" href="errore.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810761eeff.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <i class="fa-solid fa-check"></i>

        <h1>Acquisto confermato!</h1>

        <form action="loginsite.php">
            <button type="submit" id="home"> Torna alla home </button>
        </form>
    </div>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 eGaming</p>
        </div>
    </footer>
</body>
</html>