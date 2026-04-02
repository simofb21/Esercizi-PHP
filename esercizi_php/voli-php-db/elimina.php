<?php
session_start();
include("connessione.php");

if (!isset($_SESSION["compagnia"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: dashboard.php");
    exit();
}

$id_volo = $_GET["id"];

$query = "DELETE FROM voli WHERE id_volo = $id_volo";
mysqli_query($conn, $query);

header("Location: dashboard.php");
exit();
