<?php
session_start();
include("connessione.php");

if (isset($_SESSION["compagnia"])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Login compagnia</h1>

<form method="post">
    <select name="compagnia" required>
        <option value="">-- Seleziona compagnia --</option>
        <?php
        $query = "SELECT nome FROM compagnie";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['nome']}'>{$row['nome']}</option>";
        }
        ?>
    </select>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <input type="submit" name="login" value="Login">
</form>

<?php
if (isset($_POST["login"])) {
    $compagnia = $_POST["compagnia"];
    $password = $_POST["password"];

    $query = "SELECT * FROM compagnie WHERE nome='$compagnia' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["compagnia"] = $row["id_compagnia"];
        $_SESSION["nome_compagnia"] = $row["nome"];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color:red'>Login fallito</p>";
    }
}
?>

</body>
</html>
