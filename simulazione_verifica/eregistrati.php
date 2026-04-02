<?php
    session_start();
    $email = "";
    $pwd = "";
    $nome = "";
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nome'])) {
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $nome = $_POST['nome'];
    }else{
        die("Dati mancanti");
    }
    include "connessione.php";
    $query = "SELECT * from utenti where email = '$email'";
    $result = mysqli_query($connessione, $query);

    if(mysqli_num_rows($result) > 0) {
        echo"Email già registrata";
        echo "<br><a href='login.php'>Torna alla pagina di login</a>";
    }
    else{
        $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $query = "INSERT INTO utenti (nome, email, password) VALUES ('$nome', '$email', '$hash_pwd')";
        if(mysqli_query($connessione, $query)){
            echo "Registrazione avvenuta con successo";
            echo "<br><a href='login.php'>Vai alla pagina di login</a>";
        }
    }
?>