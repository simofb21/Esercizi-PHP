<?php
    include 'connessione.php';
    
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM utenti where email = '$email'";
    $result  = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1){
        echo "Email già in uso<br>";
        echo" <a href='registrati.html'>Torna a registrati</a>";
    }
    else {
        $pwd = password_hash($password,PASSWORD_BCRYPT);
        $query = "INSERT into utenti(nome,email,password) VALUES ('$nome','$email','$pwd');";
        if(mysqli_query($conn,$query)){
            echo"Registrazione completata correttamente";
            echo" <a href='login.html'>Vai al login</a>";
        }else{
            die("Errore registrazione");

        }
    }
        
?>