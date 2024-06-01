<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $temp = $_GET['prenotazione_si_no'];
    
    switch($temp){
        case 'a':
            header("Location: aggiungi_prenotazione.php?nome_prodotto={$_GET["nome_prodotto"]}");
            break;

        case 'r':
            header("Location: rimuovi_prenotazione.php?nome_prodotto={$_GET["nome_prodotto"]}");
            break;
    }
?>