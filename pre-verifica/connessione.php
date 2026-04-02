<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "e_commerce";

// Apre la connessione con il dbms
$conn = mysqli_connect($host, $user, $pass, $db);

// Verifica la connessione
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

?>