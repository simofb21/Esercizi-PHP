<?php
// Avvia la sessione per accedere ai dati salvati durante il login (id, nome)
session_start();

// Include il file per la connessione al database
include "connessione.php";

// CONTROLLO ACCESSO: Se non esiste la variabile di sessione 'id', l'utente non è loggato
if (!isset($_SESSION['id'])) {
    // Reindirizza l'utente alla pagina di login
    header("Location: login.html");
    exit(); // Blocca l'esecuzione del resto della pagina
}

// Recupera l'ID dell'utente loggato dalla sessione
$id = $_SESSION['id'];

// Messaggio di benvenuto personalizzato usando il nome salvato in sessione
echo "<h2>Benvenuto " . $_SESSION['nome'] . "</h2>";

// 1. RECUPERO ELENCO ACQUISTI
// Query con JOIN per unire la tabella 'acquisti' con 'prodotti' tramite l'ID del prodotto
$sql = "SELECT nome_prodotto, prezzo, data_acquisto
        FROM acquisti
        JOIN prodotti ON acquisti.id_prodotto = prodotti.id_prodotto
        WHERE acquisti.id_utente = $id";

// Esecuzione della query (stile imperativo)
$result = mysqli_query($conn, $sql);

// Creazione della tabella HTML per visualizzare i dati
echo "<table border='1'>";
echo "<tr><th>Prodotto</th><th>Prezzo</th><th>Data</th></tr>";

// Ciclo while: estrae una riga alla volta finché ci sono risultati
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" . $row['nome_prodotto'] . "</td>";
    echo "<td>" . $row['prezzo'] . " €</td>";
    echo "<td>" . $row['data_acquisto'] . "</td>";
    echo "</tr>";
}
echo "</table><br>";


// 2. CALCOLO DEL TOTALE SPESO
// Query che usa la funzione SQL SUM() per sommare i prezzi di tutti i prodotti acquistati dall'utente
$sql_totale = "SELECT SUM(prezzo) AS totale
               FROM acquisti
               JOIN prodotti ON acquisti.id_prodotto = prodotti.id_prodotto
               WHERE acquisti.id_utente = $id";

$result_totale = mysqli_query($conn, $sql_totale);

// Estraiamo la riga singola contenente il totale
$row_totale = mysqli_fetch_assoc($result_totale);

// Mostriamo il totale a video (se è nullo, mostriamo 0)
$totale_speso = $row_totale['totale'] ?? 0;
echo "<strong>Totale speso: " . $totale_speso . " €</strong>";

// Chiude la connessione al termine dello script
mysqli_close($conn);
?>