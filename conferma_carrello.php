<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host, $user, $pass, $db);

    $checkQUERY = "SELECT COUNT(*) AS count FROM CARRELLO";
    $result = $conn->query($checkQUERY);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $deleteQUERY = "DELETE FROM CARRELLO";
        $conn->query($deleteQUERY);
        header("Location: conferma_ordine.php");
    } else {
        if(!$_SESSION["userlogin"]){
            header("Location: admin_homepage.php");
        }else{
            header("Location: user_homepage.php");
        }
    }
?>
