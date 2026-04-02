<?php
session_start();

if (!isset($_SESSION['id_utente'])) {
    header("Location: login.php");
    exit();
}

include "connessione.php";

$id_utente = $_SESSION['id_utente'];

// calcolo totale

$query_totale = "
SELECT SUM(p.prezzo) AS totale
FROM acquisti a
JOIN prodotti p ON a.id_prodotto = p.id_prodotto
WHERE a.id_utente = $id_utente
";

$result_totale = mysqli_query($connessione, $query_totale);
$row_totale = mysqli_fetch_assoc($result_totale);

$totale ="" ;
if(isset($row_totale['totale'])){
    $totale = $row_totale['totale'];
}else {
    $totale = 0;
}

$query_prodotti = "
SELECT p.nome_prodotto, p.prezzo, a.data_acquisto
FROM acquisti a
JOIN prodotti p ON a.id_prodotto = p.id_prodotto
WHERE a.id_utente = $id_utente
";

$result_prodotti = mysqli_query($connessione, $query_prodotti);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            text-align: center;
            font-family: Arial;
        }
        table {
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>
<body>

<h1>Benvenuto <?php echo $_SESSION['email']; ?></h1>

<h2>Totale speso: € <?php echo $totale; ?></h2>

<table>
    <tr>
        <th>Prodotto</th>
        <th>Prezzo</th>
        <th>Data acquisto</th>
    </tr>

    <?php
    if (mysqli_num_rows($result_prodotti) == 0) {
        echo "<tr><td colspan='3'>Nessun acquisto</td></tr>";
    } else {
        while ($row = mysqli_fetch_assoc($result_prodotti)) {
            echo "<tr>";
            echo "<td>" . $row['nome_prodotto'] . "</td>";
            echo "<td>€ " . $row['prezzo'] . "</td>";
            echo "<td>" . $row['data_acquisto'] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>

<br><br>
<a href="logout.php">Logout</a>

</body>
</html>
