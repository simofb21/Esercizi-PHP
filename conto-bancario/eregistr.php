<?php
// Includi la tua connessione al DB
include 'connessione.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash della password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Controllo se l'email esiste già
    $stmt_check = $conn->prepare("SELECT id FROM utenti WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "Errore: Email già registrata!";
        $stmt_check->close();
        exit;
    }
    $stmt_check->close();

    // Prepared statement per inserire utente
    $stmt = $conn->prepare("INSERT INTO utenti (nome, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $passwordHash);

    if ($stmt->execute()) {
        // Creazione automatico conto con saldo iniziale 0
        $ultimo_id = $conn->insert_id;
        $saldo_iniziale = 0.00;

        $stmt2 = $conn->prepare("INSERT INTO conto (saldo, utente_id) VALUES (?, ?)");
        $stmt2->bind_param("di", $saldo_iniziale, $ultimo_id);
        $stmt2->execute();
        $stmt2->close();

        echo "Registrazione completata con successo!";
    } else {
        echo "Errore durante la registrazione: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Accesso non consentito!";
}
?>
