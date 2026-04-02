<?php
session_start();
include("connessione.php");

if (!isset($_SESSION["compagnia"])) {
    header("Location: login.php");
    exit();
}

$company = $_SESSION["compagnia"];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>Benvenuto <?php echo $_SESSION["nome_compagnia"]; ?></h1>

<a href="logout.php">Logout</a>

<hr>

<table border="1">
    <tr>
        <th>Codice volo</th>
        <th>Aereo</th>
        <th>Tipo</th>
        <th>Aeroporto</th>
        <th>Azioni</th>
    </tr>

<?php
$query = "
SELECT 
    voli.id_volo,
    voli.codice_volo,
    aerei.nome AS nome_aereo,
    aerei.tipo,
    aeroporti.nome AS nome_aeroporto
FROM voli
INNER JOIN aerei ON voli.id_aereo = aerei.id_aereo
INNER JOIN aeroporti ON voli.id_aeroporto = aeroporti.id_aeroporto
WHERE aerei.id_compagnia = $company
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='5'>Nessun volo disponibile</td></tr>";
}

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['codice_volo']}</td>";
    echo "<td>{$row['nome_aereo']}</td>";
    echo "<td>{$row['tipo']}</td>";
    echo "<td>{$row['nome_aeroporto']}</td>";
    echo "<td>
            <a href='elimina.php?id={$row['id_volo']}'
               onclick=\"return confirm('Vuoi eliminare il volo?')\">
               Elimina
            </a>
          </td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>
