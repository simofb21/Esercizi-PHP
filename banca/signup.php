<!DOCTYPE html>
<head>
    <title>Signup</title>

</head>

<body align="center">
    <h1>Signup</h1>
    <form action="signup.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <br>
        <input type="text" name="cognome" placeholder="Cognome" required>
        <br>
        <input type="number" name="saldo" placeholder="Saldo iniziale" required>
        <br>
        <input type="text" name="username" placeholder="username" required>
        <br>
        <input type="text" name="password" placeholder="Password" type="text" required>
        <br>
        <input type="submit" value="Signup">
    </form>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connessione.php';
    if (! isset($_POST['username']) || ! isset($_POST['password']) || ! isset($_POST['nome']) || ! isset($_POST['cognome']) ) {
        echo 'Compila tutti i campi';
        exit();
    }
        $username = $_POST['username'];
        $password = $_POST['password'];

        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $saldo = $_POST['saldo'];
        //$nome = mysqli_real_escape_string($conn, $_POST['nome']);
        //$cognome = mysqli_real_escape_string($conn, $_POST['cognome']);

         //$query = "INSERT INTO abbonamento (username, password) VALUES ('$username', '$password')";
        //$result = mysqli_query($conn, $query);
        $stmt = $conn->prepare("INSERT INTO account (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $result = $stmt->execute();


        $id = "SELECT id FROM account WHERE username='$username'";
        $result = mysqli_query($conn, $id);
        //$stmt = $conn->prepare("SELECT id FROM account WHERE username=?");
        //$stmt->bind_param("s", $username);
        //$result = $stm->execute()->get_result();
        $id = mysqli_fetch_assoc($result)['id'];

        $query = "INSERT INTO conti (nominativo, saldo, account) VALUES ('$nome $cognome', $saldo, '$id')";
        $result = mysqli_query($conn, $query);
        //$stmt = $conn->prepare("INSERT INTO conti (nominativo, saldo, account) VALUES (?, 0, ?)");
        //$stmt->bind_param("si", "$nome $cognome", $id);
        //$result = $stmt->execute()->get_result();
        
        if ($result) {
        session_start();
        session_destroy();
        session_start();
        $_SESSION['userid'] = $id;
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Errore durante la registrazione';
    }

    mysqli_close($conn);
}
?>