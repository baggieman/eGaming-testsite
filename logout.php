<?php
session_start();

session_unset();
session_destroy();

$host = "localhost";
$user = "root";
$pass = "";
$db = "dbsite";

$conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

$QUERY1 = "SELECT * FROM CARRELLO";
$result1 = $conn->query($QUERY1);

while( $row2 = $result1->fetch_assoc()){
    $QUERY2 = "INSERT INTO GIOCHI(NomeG,Tipologia,Descrizione,Prezzo) VALUES(\"{$row2['NomeG']}\", \"{$row2['Tipologia']}\", \"{$row2['Descrizione']}\", {$row2['Prezzo']})";
    $conn->query($QUERY2);
}

$QUERY = "DELETE FROM CARRELLO";
$conn->query($QUERY);

header("Location: loginsite.php");
?>