<?php
// Include il file di configurazione per stabilire la connessione al database
include "connessione.php";

// Recupera i dati inviati tramite il metodo POST dal form di registrazione
$nome = $_POST['nome'];
$email = $_POST['email'];
$password = $_POST['password'];

// Query per verificare se l'email inserita esiste già nel database
$sql = "SELECT * FROM utenti WHERE email='$email'";
$result = mysqli_query($conn, $sql);

// Se la query restituisce almeno una riga, l'utente è già presente
if (mysqli_num_rows($result) > 0) {
    echo "Email già registrata";
} else {
    // Crea un hash sicuro della password prima di salvarla (mai salvare in chiaro!)
    // PASSWORD_BCRYPT genera una stringa di 60 caratteri
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepara la query di inserimento con i dati dell'utente e la password criptata
    $sql = "INSERT INTO utenti(nome, email, password)
            VALUES('$nome', '$email', '$hash')";

    // Esegue la query e verifica se l'operazione è andata a buon fine
    if (mysqli_query($conn, $sql)) {
        echo "Registrazione completata";
    } else {
        // Messaggio generico in caso di errore tecnico del database
        echo "Errore durante la registrazione";
    }
}
?>