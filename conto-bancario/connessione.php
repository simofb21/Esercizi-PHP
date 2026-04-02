<?php
$conn = mysqli_connect("localhost", "root", "", "contobancario");

if(!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>