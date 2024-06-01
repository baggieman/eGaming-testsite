<!DOCTYPE html>
<html lang="en">

<?php
    //error_reporting(E_ERROR | E_PARSE);
    session_start();

    if($_SESSION['islogged'] == false){
        header("Location: loginsite.php");
    }

    $usercheck = $_SESSION['name'];

    if($usercheck !="sperdax" && $usercheck !="pezzox")
    {
        header("Location: user_homepage.php");
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eGaming</title>
    <link rel="stylesheet" href="admin_homepage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810761eeff.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>eGaming</h1>
            <input type="checkbox" id="check3" aria-hidden="true">
            <div class="icona-carrello-container">
                <label id="carrello-label" for="check3"><i class="fa-solid fa-cart-shopping"></i></label>
            </div>
            <div class="prova">
                <div class="dati-carrello-container">
                    <table style="width: 100%" style="height: 80%" id="carrello-table">
                        <tr>
                            <th style="width: 10%;"></th>
                            <th style="width: 60%;">Titolo</th>
                            <th style="width: 15%;">Prezzo</th>
                            <th style="width: 15%;">Quantità</th>
                        </tr>
                        <?php
                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "dbsite";

                            $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

                            $QUERY = "SELECT NomeG, Prezzo, COUNT(*) AS Quantita FROM CARRELLO GROUP BY NomeG, Prezzo ORDER BY NomeG";
                            $ris = $conn->query($QUERY);

                            $i=0;
                                
                            while (($r=$ris->fetch_assoc()) != NULL){
                                $i++;
                                echo "<tr>";
                                echo "<td>{$i}</td><td>{$r['NomeG']}</td><td>{$r['Prezzo']}€</td><td style='text-align: right;'>{$r['Quantita']}</td>";
                                echo "</tr>";
                                echo "<tr><td colspan='5'>&nbsp;</td></tr>";
                            }
                        ?>
                    </table>
                </div>
                <div class="carrello-buttons">
                    <form action="totale_carrello.php" method="get">
                        <button type="submit" id="conferma-button">Conferma</button>
                    </form>
                    <form action="azzera_carrello.php" method="get">
                        <button type="submit" id="azzera-button">Azzera</button>
                    </form>
                </div>
            </div>
            <form action="logout_page.php">
                <button type="submit" id="logout-button"><i class="fa-regular fa-user"></i><?php $current_user = $_SESSION['name']; echo " $current_user"; ?><br><br>Logout <i class="fa-solid fa-right-to-bracket"></i></button>
            </form>
        </div>
    </header>
    <section class="hero">
        <div class="container">
            <h2>Scopri la nostra gamma di giochi!</h2>
            <p>Il migliore shop di videogiochi in tutto l'universo</p>
        </div>
    </section>
    <div class="container-generale">
        <div class="buttons">
            <input type="checkbox" id="check1" aria-hidden="true">
            <input type="checkbox" id="check2" aria-hidden="true">
            <div class="acquisto-container">
                <form action="aggiungi_carrello.php" method="get" id="form-acquisto">
                    <label for="check1" aria-hidden="true">Aggiungi al carrello</label><br>
                    <select name="nome_prodotto" id="input3">
                        <?php
                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "dbsite";

                            $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

                            $QUERY = "SELECT NomeG FROM GIOCHI GROUP BY NomeG";
                            $ris = $conn->query($QUERY);
                                
                            if ($ris->num_rows > 0) {
                                while($row = $ris->fetch_assoc()) {
                                    echo "<option value='" . $row["NomeG"] . "'>" . $row["NomeG"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nessuna opzione disponibile</option>";
                            }
                        ?>
                    </select>
                    <div class="acquisto-input">
                        <select name="piattaforma" id="input1">
                            <option value="pc">PC</option>
                            <option value="ps4">PlayStation 4</option>
                            <option value="ps5">PlayStation 5</option>
                            <option value="xbox_one">Xbox One</option>
                            <option value="xbox_x">Xbox Series X</option>
                        </select>
                        <input type="number" id="input2" name="quantita_acquista" placeholder="Quantità da acquistare" min="1" required>
                    </div>
                    <button type="submit">Aggiungi</button>
                </form>
            </div>
            <div class="prenotazione-container">
                <form action="prenotazione.php" method="GET" id="form-prenotazione">
                    <label for="check1" aria-hidden="true">Prenota</label>
                    <select name="nome_prodotto" id="input3">
                        <?php
                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "dbsite";

                            $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

                            $QUERY = "SELECT NomeG FROM GIOCHI GROUP BY NomeG";
                            $ris = $conn->query($QUERY);
                                
                            if ($ris->num_rows > 0) {
                                while($row = $ris->fetch_assoc()) {
                                    echo "<option value='" . $row["NomeG"] . "'>" . $row["NomeG"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nessuna opzione disponibile</option>";
                            }
                        ?>
                    </select>
                    <select name="piattaforma">
                            <option value="pc">PC</option>
                            <option value="ps4">PlayStation 4</option>
                            <option value="ps5">PlayStation 5</option>
                            <option value="xbox_one">Xbox One</option>
                            <option value="xbox_x">Xbox Series X</option>
                        </select>
                    <select name="prenotazione_si_no" required>
                        <option value="a">Aggiungi prenotazione</option>
                        <option value="r">Rimuovi prenotazione</option>
                    </select>
                    <button type="submit">Prenota</button>
                </form>
            </div>
            <div class="rifornimento-container">
                <form action="rifornimento.php" method="get" id="form-rifornimento">
                    <label for="check2" aria-hidden="true">Rifornisci</label>
                    <input list="games" name="nome_prodotto" id="input3" placeholder="Nome gioco">
                    <datalist id="games">
                        <?php
                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "dbsite";

                            $conn = new mysqli($host,$user,$pass,$db) or die("Connessione Fallita.");

                            $QUERY = "SELECT NomeG FROM GIOCHI GROUP BY NomeG";
                            $ris = $conn->query($QUERY);
                                
                            if ($ris->num_rows > 0) {
                                while($row = $ris->fetch_assoc()) {
                                    echo "<option value='" . $row["NomeG"] . "'>" . $row["NomeG"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nessuna opzione disponibile</option>";
                            }
                        ?>
                    </datalist>
                    <input type="text" name="tipologia" placeholder="Tipologia">
                    <input type="text" name="descrizione" placeholder="Descrizione">
                    <input type="number" name="prezzo" placeholder="Prezzo">
                    <input type="number" name="quantita_rifornimento" placeholder="Quantità da rifornire" min="1" required>
                    <button type="submit">Rifornisci</button>
                </form>
            </div>
        </div>

        <div class="tables">
            <table style="width:100%">
                <tr>
                  <th style="width: 15%;">Titolo</th>
                  <th style="width: 15%">Tipologia</th>
                  <th style="width: 50%;">Descrizione</th>
                  <th>Prezzo</th>
                  <th>Disponibili</th>
                </tr>

                <?php
                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "dbsite";

                $conn = new mysqli($host, $user, $pass, $db) or die("Connessione Fallita.");

                $QUERY = "SELECT NomeG, Tipologia, Descrizione, Prezzo, 
                                COUNT(*) AS Quantita, 
                                COUNT(CASE WHEN Prenotato = 1 THEN 1 ELSE NULL END) AS Quantita_Prenotata, 
                                (COUNT(*) - COUNT(CASE WHEN Prenotato = 1 THEN 1 ELSE NULL END)) AS Quantita_Disponibile 
                        FROM GIOCHI 
                        GROUP BY NomeG, Tipologia, Descrizione, Prezzo 
                        ORDER BY NomeG";

                $ris = $conn->query($QUERY);

                while (($r = $ris->fetch_assoc()) != NULL) {
                    $quantita_disponibile = $r['Quantita_Disponibile'] == 0 ? "ESAURITO" : $r['Quantita_Disponibile'];
                    echo "<tr>";
                    echo "<td>{$r['NomeG']}</td><td>{$r['Tipologia']}</td><td>{$r['Descrizione']}</td><td>{$r['Prezzo']}€</td><td>{$quantita_disponibile}</td>";
                    echo "</tr>";
                    echo "<tr><td colspan='5'>&nbsp;</td></tr>";
                }
                ?>

            </table>
        </div>
    </div>
    
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 eGaming</p>
        </div>
    </footer>
</body>
</html>