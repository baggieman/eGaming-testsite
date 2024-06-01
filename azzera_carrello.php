<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $QUERY3 = "SELECT * FROM CARRELLO";
    $ris = $conn->query($QUERY3);

    for( $i = 0; $i < $ris->num_rows; $i++ ){
        $row2 = $ris->fetch_assoc();
        $QUERY2 = "INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo) VALUES (\"{$row2['NomeG']}\", \"{$row2['Tipologia']}\", \"{$row2['Descrizione']}\", {$row2['Prezzo']})";
        $ris2 = $conn->query($QUERY2);
    }

    $QUERY = "DELETE FROM CARRELLO";

    $conn->query($QUERY);

    if(!$_SESSION['userlogin']){
        header("Location: admin_homepage.php");
    } else {
        header("Location: user_homepage.php");
    }
?>