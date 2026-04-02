<?php
//credenziali
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestra";
$conn = new mysqli($servername, $username, $password, $dbname);
// controlla la connessione 
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>