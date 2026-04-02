<?php
// Connessione al database
$conn = mysqli_connect("localhost", "root", "", "catalogo_db");

// Controllo connessione
if (!$conn) {
    die("Errore di connessione" . mysqli_connect_error() );
}

// Variabile ricerca
$ricerca = "";  

// Se il form è stato inviato
if (isset($_GET['ricerca'])) {  
    $ricerca = $_GET['ricerca'];

    // Query SQL semplice
    $query = "SELECT nome, descrizione, prezzo 
              FROM prodotti 
              WHERE nome LIKE '%$ricerca%'";

    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Catalogo prodotti</title>
</head>
<body>

<h2>Catalogo prodotti</h2>

<form method="get">
    Cerca:
    <input type="text" name="ricerca">
    <input type="submit" value="Cerca">
</form>

<br>

<?php
// Mostra risultati solo se la query è stata eseguita
if (isset($result)) {

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Nome</th><th>Descrizione</th><th>Prezzo</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['descrizione'] . "</td>";
            echo "<td>" . $row['prezzo'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nessun prodotto trovato";
    }
}
?>

</body>
</html>

<?php
// Chiude la connessione
mysqli_close($conn);
?>
