<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $nome_prodotto = $_GET['nome_prodotto'];

    $QUERY1 = "SELECT * FROM GIOCHI WHERE NomeG = '$nome_prodotto'";

    $ris = $conn->query($QUERY1);
    while (($r=$ris->fetch_assoc()) != NULL){
        if($r['Prenotato'] != 1){
            $QUERY2 = "UPDATE GIOCHI SET Prenotato = 1 WHERE NomeG = '$nome_prodotto' AND Prenotato != 1 LIMIT 1";
            $conn->query($QUERY2);
            break;
        }
    }

    $user = $_SESSION['name'];

    if($_SESSION["userlogin"] == true){
        header("Location: user_homepage.php");
    }else{
        header("Location: admin_homepage.php");
    }
?>