<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $QUERY = "SELECT NomeG, Tipologia, Descrizione, Prezzo, COUNT(*) AS Quantita FROM GIOCHI GROUP BY NomeG, Tipologia, Descrizione, Prezzo";

    $ris = $conn->query($QUERY);
    while (($r=$ris->fetch_assoc()) != NULL){
        echo $r['NomeG'] . " " . $r['Tipologia'] . " " . $r['Descrizione'] . " " . $r['Prezzo'] . " " . $r['Quantita'] . "<br>";
    }

?>