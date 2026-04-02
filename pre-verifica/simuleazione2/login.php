<?php

    session_start();
    include 'connessione.php';
    if(isset($_SESSION['userID'])){
        $_SESSION['msg'] = "Utente già loggato";
        header('Location: dashboard.php');
    }
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $query = "SELECT * from utenti where email = '$email'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows ($result) == 1){
        $utente = mysqli_fetch_assoc($result);
        if(password_verify($pwd,$utente['password'])){
            $_SESSION['userID'] = $utente['id'];
            $_SESSION['msg']="Benvenuto " .  $utente['nome'];
            header('Location: dashboard.php');
            exit();
        }
        else{
            echo "password errata";
            echo"<br> <a href='login.html'>Vai al login</a>";

        }
    }else {
        echo "Utente inesistente";
        echo" <br><a href='login.html'>Vai al login</a>";
    }

    mysqli_close($conn);

?>