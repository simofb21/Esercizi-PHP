<?php

    session_start();
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $pwd = $_POST['password'];
    }
    include "connessione.php";
    $query = "SELECT * from utenti where email = '$email'";
    $result = mysqli_query($connessione, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pwd, $row['password'])){
            $_SESSION['email'] = $email;
            $_SESSION['id_utente'] = $row['id'];
            header("Location: visualizza.php");
        }else{
            echo "Password errata";
            echo "<br><a href='login.php'>Torna alla pagina di login</a>";
        }
    }else{
        echo "Email non trovata";
        echo "<br><a href='login.php'>Torna alla pagina di login</a>";
    }
?>