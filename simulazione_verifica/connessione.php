<?php
    $connessione = mysqli_connect("localhost", "root", "", "e_commerce");
    if(!$connessione){
        die("Connessione fallita: " . mysqli_connect_error());
    }
?>
