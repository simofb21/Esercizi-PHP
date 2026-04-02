<?php
session_start();
if (! isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
}
?>

<html align="center">
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <a href="logout.php">Logout</a>
       <br><br><br>
       <h1>Dashboard</h1>   
       <?php
         include 'connessione.php';
            $id = $_SESSION['userid'];
            $query = "SELECT saldo, nominativo FROM conti WHERE account=$id";
            $result = mysqli_query($conn, $query);
            //$stmt = $conn->prepare("SELECT saldo, nominativo FROM conti WHERE account = ?");
            //$stmt->bind_param('i', $id);
            //$result = $stmt->execute()->get_result();

            $row = $result->fetch_assoc();
            $saldo =  $row['saldo'] ;
            $nominativo =  $row['nominativo'];
            echo "<p>Nominativo: $nominativo</p>";
            echo "<h2>Saldo: $saldo €</h2>";
         ?>


    </body>
</html>
