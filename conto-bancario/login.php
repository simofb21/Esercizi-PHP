<?php
session_start();
include ("connessione.php");

if(isset($_POST['username'])){
    $user = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM utente WHERE username = ?";
    $stmt = mysqli_prepare($connessione, $sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
    }
}
?>