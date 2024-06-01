<?php
// Parametri di connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsite";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "DROP DATABASE IF EXISTS dbsite";
if ($conn->query($sql) !== TRUE) {
    die("Errore nella cancellazione del database: " . $conn->error);
}

$sql = "CREATE DATABASE dbsite";
if ($conn->query($sql) !== TRUE) {
    die("Errore nella creazione del database: " . $conn->error);
}

$conn->select_db($dbname);

$sql = "
CREATE TABLE USER(
    Nome nvarchar(255) NOT NULL,
    Cognome nvarchar(255) NOT NULL,
    Username nvarchar(255) PRIMARY KEY NOT NULL UNIQUE,
    Pass varchar(255) NOT NULL
);

CREATE TABLE GIOCHI(
    Matricola int PRIMARY KEY AUTO_INCREMENT,
    NomeG nvarchar(255) NOT NULL,
    Tipologia nvarchar(255) NOT NULL,
    Descrizione nvarchar(2000) NOT NULL,
    Prezzo int NOT NULL,
    Prenotato tinyint(1) NOT NULL
);

CREATE TABLE CARRELLO(
    Matricola int PRIMARY KEY AUTO_INCREMENT,
    NomeG nvarchar(255) NOT NULL,
    Tipologia nvarchar(255) NOT NULL,
    Descrizione nvarchar(2000) NOT NULL,
    Prezzo int NOT NULL
);
";
if ($conn->multi_query($sql) !== TRUE) {
    die("Errore nella creazione delle tabelle: " . $conn->error);
}

while ($conn->more_results() && $conn->next_result()) {
}

$sql = "
INSERT INTO USER(Nome, Cognome, Username, Pass) VALUES ('Mattia', 'Sperduto', 'sperdax', SHA2('admin', 256));
INSERT INTO USER(Nome, Cognome, Username, Pass) VALUES ('Nizar', 'Pezzolato', 'pezzox', SHA2('admin', 256));
";
if ($conn->multi_query($sql) !== TRUE) {
    die("Errore nell'inserimento dei dati nella tabella USER: " . $conn->error);
}

while ($conn->more_results() && $conn->next_result()) {
}

$sql = "
CREATE PROCEDURE InsertLoop()
BEGIN
    DECLARE counter INT DEFAULT 0;

    WHILE counter < 2 DO
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Elden Ring', 'Azione, Avventura', 'Elden Ring per PC è un gioco di ruolo d''azione (ARPG) scritto dalle superstar George RR Martin (l''autore della serie di libri Le Cronache del Ghiaccio e del Fuoco che ha dato origine alla serie televisiva Game of Thrones) e Hidetaka Miyazake (famoso per molti popolari videogiochi: dalla serie Souls, a Bloodborne, a Sekiro).', 60);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Dark Souls Remastered', 'Azione, RPG', 'E poi venne il Fuoco. Rivivi l''esperienza che ha rivoluzionato il mondo dei videogiochi e dato vita a un nuovo genere. Esplora la terra di Lordran in una splendida versione rimasterizzata in altissima definizione a 60 fps. Dark Souls Remastered include il gioco base e il DLC Artorias of the Abyss.', 40);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Dark Souls II: Scholar of the First Sin', 'Azione, RPG', 'DARK SOULS II: Scholar of the First Sin porta la famigerata oscurità e l''avvincente giocabilità della serie a un nuovo livello. Incamminati nell''oscurità e scopri i nuovi ed emozionanti incontri con i nemici, gli ostacoli diabolici e la sfida implacabile.', 40);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Dark Souls III', 'Azione, RPG', 'Dark Souls 3 per PC è un gioco di ruolo fantasy, il quarto della serie e segue immediatamente il suo predecessore, Dark Souls 2. Il gioco è ambientato in un universo immaginario, il Regno di Lothric, dove il lungo periodo di illuminazione (letteralmente) è minacciato dall''avvento dell''Età dell''Oscurità. Il giocatore deve garantire la sopravvivenza dell''Età del fuoco assicurando che la Prima fiamma continui a bruciare a lungo.', 60);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Sekiro: Shadows Die Twice', 'Azione, RPG', 'In Sekiro: Shadows Die Twice vestirai i panni di un ''lupo senza un braccio'', un guerriero sfregiato e caduto in disgrazia, salvato a un passo dalla morte. Il tuo destino è legato a un giovane di nobili origini, discendente di un''antica stirpe: per proteggerlo affronterai numerosi nemici, tra cui lo spietato clan Ashina. Niente ti fermerà nella pericolosa missione per riscattare il tuo onore e liberare il giovane signore, nemmeno la morte stessa.', 60);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Minecraft', 'Multiplayer, RPG, Sandbox', 'Minecraft per PC è il videogioco più venduto di tutti i tempi. Questo da solo dovrebbe essere sufficiente per farlo comprare, ma ecco qualche informazione in più sul perché dovresti iniziare a giocare ora. È un gioco sandbox in cui ogni giocatore può scavare, costruire e creare il proprio mondo ideale.', 20);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Library of Ruina', 'Deck builder, Indie', 'Un tableau che riguarda il protagonista e la bibliotecaria che si smarriscono nella misteriosa biblioteca, in cui si intrecciano vita e desideri.', 35);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('It takes two', 'Co-op, Azione, Avventura', 'It Takes Two per PC è un gioco di azione e avventura degli sviluppatori Hazelight - che hanno anche creato A Way Out, vincitore di un BAFTA - e pubblicato dal gigante dei giochi EA Games. È un gioco cooperativo per due giocatori.', 40);
        INSERT INTO GIOCHI(NomeG, Tipologia, Descrizione, Prezzo)
        VALUES ('Portal 2', 'Platform 3D, Puzzle', 'Portal 2 attinge dalla premiata formula di innovativa giocabilità, storia e musica che è valsa al primo Portal oltre 70 premi di settore e che ha generato un culto.', 10);
        SET counter = counter + 1;
    END WHILE;
END
";
if ($conn->query($sql) !== TRUE) {
    die("Errore nella creazione della procedura: " . $conn->error);
}

$sql = "CALL InsertLoop()";
if ($conn->query($sql) !== TRUE) {
    die("Errore nella chiamata della procedura: " . $conn->error);
}

echo "Database e tabelle create con successo<br>";
echo '<a href="loginsite.php">Vai al login</a>';

$conn->close();
?>
