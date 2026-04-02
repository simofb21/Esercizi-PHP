<?php

session_start();
include "connessione.php";
if(!isset($_SESSION['id_abbonamento'])){
    header("Location: login.php");
    exit();
}
$id_corso = $_POST['corso'];
$id_abbonamento = $_SESSION['id_abbonamento'];
$data = date("Y-m-d");

mysqli_query($conn,"
INSERT INTO Prenotazione (data_prenotazione,id_abbonamento,id_corso)
VALUES ('$data',$id_abbonamento,$id_corso)
");

mysqli_query($conn,"
UPDATE Corsi
SET num_posti = num_posti - 1
WHERE id_corso = $id_corso
");

echo "Prenotazione effettuata!<br><br>";

echo "<a href='prenotazione.php'>Torna indietro</a> | ";
echo "<a href='visualizza_prenotazione.php'>Le mie prenotazioni</a> | ";
echo "<a href='logout.php'>Logout</a>";

?>
