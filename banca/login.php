<!DOCTYPE html>
<head>
    <title>Login</title>
    
</head>

<body style="text-align: center;">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="username">
        <br>
        <input type="text" name="password" placeholder="Password">
        <br>
        <input type="submit" value="Login">
        <p><a href="signup.php">Registrati</a></p>
    </form>

</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connessione.php';
    if (! isset($_POST['username']) || ! isset($_POST['password'])) {
        echo 'Compila tutti i campi';
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT id, password FROM account WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // $query = "SELECT id, password FROM account WHERE username='$username' AND password='$password'";
    // $result = mysqli_query($conn, $query);
    //versione con vulnerabilità SQL injection

    $row = $result->fetch_assoc();

    if ($row) {
        session_start();
        $_SESSION['userid'] = $row['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Password o username errati';
    }

    mysqli_close($conn);
}
?>
