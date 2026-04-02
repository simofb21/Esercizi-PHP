<?php
session_start();
include "connessione.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM Abbonamento WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
$utente = mysqli_fetch_assoc($result);

if ($num_rows == 1 && password_verify($password, $utente['password'])) {
    $_SESSION['id_abbonamento'] = $utente['id_abbonamento'];
    $_SESSION['nome'] = $utente['nome'];
    header("Location: prenotazione.php");
    exit();
} else 
    header(header: "Location: login.php?msg_reg=Email o password errati");
    exit();
?>
