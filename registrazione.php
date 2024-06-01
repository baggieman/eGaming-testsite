<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hash_pass = hash("sha256",$password,false);

    $QUERY2 = "SELECT Username FROM USER";

    $ris = $conn->query($QUERY2);
    while ( ($r=$ris->fetch_assoc()) != NULL){
        if($r['Username'] == $username){
            header("Location: user_error.php");
        }
    }

    $QUERY1 = "INSERT INTO USER(Nome, Cognome, Username, Pass) VALUES('$name','$surname','$username','$hash_pass')";

    $conn->query($QUERY1);

    session_start();

    $_SESSION['name'] = $username;
    $_SESSION['islogged'] = true;
    $_SESSION["userlogin"] = true;

    header('Location: user_homepage.php');

?>  