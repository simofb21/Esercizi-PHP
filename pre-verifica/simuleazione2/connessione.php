<?php
    $username = "root";
    $password = "";
    $host = "localhost";
    $nome_db  ="cinema";
    $conn  = mysqli_connect($host,$username,$password,$nome_db); // ordine : localhost,username,password,nome db
    if(!$conn)
        die("Impossibile stabilire la connessione al db");
?>
