<?php
// Inizia o riprende la sessione dell'utente (necessario per salvare i dati di login)
session_start();

// Include il file per stabilire la connessione al database
include "connessione.php";

// Recupera le credenziali inviate dal form tramite il metodo POST
// NOTA: In un sistema reale, usa mysqli_real_escape_string($conn, $_POST['email']) per sicurezza
$email = $_POST['email'];
$password = $_POST['password'];

// Prepara la query per cercare l'utente nel database tramite l'email
$sql = "SELECT * FROM utenti WHERE email='$email'";
$result = mysqli_query($conn, $sql);

// Verifica se la query ha restituito esattamente una riga (utente trovato)
if (mysqli_num_rows($result) == 1) {

    // Estrae i dati dell'utente dal risultato della query come array associativo
    $utente = mysqli_fetch_assoc($result);

    // Confronta la password inserita con l'hash salvato nel database
    // password_verify decripta l'hash e restituisce true se corrispondono
    if (password_verify($password, $utente['password'])) {

        // Se la password è corretta, salva i dati principali dell'utente nella sessione
        $_SESSION['id'] = $utente['id'];
        $_SESSION['nome'] = $utente['nome'];

        // Reindirizza l'utente alla pagina riservata (dashboard)
        header("Location: dashboard.php");
        exit(); // Interrompe l'esecuzione dello script dopo il reindirizzamento
    } else {
        // Messaggio mostrato se l'hash della password non corrisponde
        echo "Password errata";
    }

} else {
    // Messaggio mostrato se l'email non è presente nel database
    echo "Utente non trovato";
}

// Chiude la connessione al database
mysqli_close($conn);
?>