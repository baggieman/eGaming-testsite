<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $nome_prodotto = $_GET['nome_prodotto'];
    $tipologia = $_GET['tipologia'];
    $descrizione = $_GET['descrizione'];
    $prezzo = $_GET['prezzo'];
    $quantita_rifornita = $_GET['quantita_rifornimento'];

    $QUERY2 = "SELECT * FROM GIOCHI WHERE NomeG = '$nome_prodotto'";

    $ris = $conn->query($QUERY2);
    if (($row2=$ris->fetch_assoc()) != NULL){
        for ($i = 0; $i < $quantita_rifornita ; $i++) {
        $QUERY3 = "INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo) VALUES(\"{$row2['NomeG']}\", \"{$row2['Tipologia']}\", \"{$row2['Descrizione']}\", {$row2['Prezzo']})";
        $conn->query($QUERY3);
        }
    } else {    
        for ($i = 0; $i < $quantita_rifornita ; $i++) {
            $QUERY1 = "INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo) VALUES('$nome_prodotto','$tipologia','$descrizione','$prezzo')";
            $conn->query($QUERY1);
        }
    }

    $user = $_SESSION['name'];

    if($_SESSION["userlogin"] == true){
        header("Location: user_homepage.php");
    }else{
        header("Location: admin_homepage.php");
    }
    
?>