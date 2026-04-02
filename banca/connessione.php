<?php

$conn = mysqli_connect('localhost', 'root', '', 'banca');
if (! $conn) {
    exit('Connessione fallita: '.mysqli_connect_error());
}
