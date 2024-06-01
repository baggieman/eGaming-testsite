<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $nome_prodotto = $_GET['nome_prodotto'];
    $quantita_acquistata = $_GET['quantita_acquista'];
    $QUERY3 = "SELECT COUNT(*) AS Quantita_in_stock FROM GIOCHI WHERE NomeG = '$nome_prodotto' AND Prenotato = 0";
    $ris2 = $conn->query($QUERY3);

    if($row = $ris2->fetch_assoc()){
        if($row['Quantita_in_stock'] >= $quantita_acquistata){

            $QUERY5 = "SELECT * FROM GIOCHI WHERE NomeG = '$nome_prodotto' AND Prenotato != 1";
            $ris5 = $conn->query($QUERY5);
            $row2 =$ris5->fetch_assoc();

            for( $i = 0; $i < $quantita_acquistata; $i++){
                $QUERY4 = "INSERT INTO CARRELLO(NomeG,Tipologia,Descrizione,Prezzo) VALUES(\"{$row2['NomeG']}\", \"{$row2['Tipologia']}\", \"{$row2['Descrizione']}\", {$row2['Prezzo']})";
                $conn->query($QUERY4);
            }

            $QUERY2 = "DELETE FROM GIOCHI WHERE NomeG = '$nome_prodotto' AND Prenotato != 1 LIMIT $quantita_acquistata";
            $conn->query($QUERY2);
            
            if($_SESSION["userlogin"] == true){
                header("Location: user_homepage.php");
            }else{
                header("Location: admin_homepage.php");
            }
        }else{
            header("Location: errore.php");
        }
    }



?>