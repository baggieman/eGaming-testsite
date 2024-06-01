<!DOCTYPE html>
<html lang="en">

<?php

    $host = "localhost";
    $user = "root";
    $pass = "";                
    $db = "dbsite";
    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

    function isTableEmpty($conn, $tableName) {
        $sql = "SELECT COUNT(*) AS count FROM $tableName";
        $result = $conn->query($sql);
    
        if ($result === FALSE) {
            die("Errore nell'esecuzione della query: " . $conn->error);
        }
    
        $row = $result->fetch_assoc();
        $count = $row['count'];
        return ($count == 0);
    }

    //error_reporting(E_ERROR | E_PARSE);
    session_start();

    if($_SESSION['islogged'] == false){
        header("Location: loginsite.php");
    }

    if(isTableEmpty($conn,"CARRELLO")){
        if(!$_SESSION["userlogin"]){
            header("Location: admin_homepage.php");
        }else{
            header("Location: user_homepage.php");
        }
    }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eGaming</title>
    <link rel="stylesheet" href="carrello.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810761eeff.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>eGaming</h1>
        <h2>Riepilogo ordine</h2>
        <div class="dati-carrello-container">
            <table style="width: 100%" style="height: 80%" id="carrello-table">
                <tr>
                    <th style="width: 5%;"></th>
                    <th style="width: 10%;">Titolo</th>
                    <th style="width: 10%;">Tipologia</th>
                    <th style="width: 65%;">Descrizione</th>
                    <th style="width: 5%;">Prezzo</th>
                    <th style="width: 5%;">Quantità</th>
                </tr>
                <?php
                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $db = "dbsite";

                    $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

                    $QUERY = "SELECT NomeG, Tipologia, Descrizione, Prezzo, COUNT(*) AS Quantita FROM CARRELLO GROUP BY NomeG, Prezzo ORDER BY NomeG";
                    $ris = $conn->query($QUERY);

                    $i = 0;
                    $totale = 0;
                                    
                    while (($r=$ris->fetch_assoc()) != NULL){
                        $i++;
                        echo "<tr>";
                        echo "<td>{$i}</td><td>{$r['NomeG']}</td><td>{$r['Tipologia']}</td><td>{$r['Descrizione']}</td><td>{$r['Prezzo']}€</td><td style='text-align: right;'>{$r['Quantita']}</td>";
                        echo "</tr>";
                        echo "<tr><td colspan='5'>&nbsp;</td></tr>";
                        $totale = $totale + ($r['Prezzo'] * $r['Quantita']); 
                    }
                ?>
            </table>
        </div>
        <p id="totale-carrello"><?php
            echo "Totale carrello: " . $totale . "€";
        ?></p>
        <div class="dati">
            <h2>SI ACCETTANO SOLO PAGAMENTI CON CARTA DI CREDITO O DEBITO</h2>
            <p>inserisci i seguenti dati:<br></p>
            <form action="conferma_ordine.php" method="get" id="cartaform">
                <div class="div3">
                    <div class="div1">
                        <label for="numerocarta"> Numero carta:</label>
                        <input type="text" id="numerocarta" name="numerocarta" pattern="\d{4}-\d{4}-\d{4}-\d{4}" maxlength="20" placeholder="####-####-####-####" required>
                        <label for="nome">Nome sulla carta:</label>
                        <input type="text" name="nome" id="nome" placeholder="es. Mario Rossi" required>
                    </div>
                    <div class="div2">
                        <label for="scadenza">Data di scadenza:</label>
                        <input type="text" id="scadenza" name="scadenza" placeholder="MM/YY" pattern="\d{2}/\d{2}" required>
                        <label for="cvv">CVV:</label>
                        <input type="number" id="cvv" name="cvv" pattern="\d{3}" minlength="3" maxlength="3" placeholder="###" required>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" id="button1">Conferma</button>
            </form>
                    <form action="azzera_carrello.php" method="get" id="azzerabutton">
                    <button type="submit" id="button2">Azzera</button>
                    </form>
        </div>
        <p id="oppure">oppure</p>
        <form action="login.php">
            <button type="submit" id="button3">Torna al sito</button>
        </form>
    </div>
        
                
    </div>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 eGaming</p>
        </div>
    </footer>
</body>
</html>