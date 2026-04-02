<?php
include "connessione.php";
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$password = $_POST['password'];
$data_nascita = $_POST['data_nascita'];
$password = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO Abbonamento (nome, cognome, email, password, data_nascita) VALUES ('$nome', '$cognome', '$email', '$password', '$data_nascita')";
if (mysqli_query($conn, $sql)) {
    header("Location: login.php?msg_reg=Registrazione avvenuta con successo");
    exit();
} else {
    echo "Errore: ";
}
mysqli_close(mysql: $conn);
?>