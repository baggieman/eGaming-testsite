<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dbsite";

    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    $username = $_POST["username"];
    $pass = $_POST["password"];

    $hash_pass = hash("sha256",$pass,false);
    $QUERY = "SELECT * FROM USER";

    $ris = $conn->query($QUERY);
    $flag = false;
    while ( ($r=$ris->fetch_assoc()) != NULL){
        if($r['Username'] == $username && $r['Pass'] == $hash_pass){
            $flag = true;
            session_start();

            $_SESSION['name'] = $username;
            $_SESSION['islogged'] = true;

            if($r['Username'] == "sperdax" OR $r['Username'] == "pezzox"){
                header("Location: admin_homepage.php");
            } else {
                header("Location: user_homepage.php");
                $_SESSION["userlogin"] = true;
            }
        }
    }
    
    if(!$flag){
        header("Location: loginsite.php");
    }
?>