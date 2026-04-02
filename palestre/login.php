<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title></head>
<body>

<h2>Login</h2>

<form action="controllo_login.php" method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Accedi</button>
</form>
    <p>Non registrato ? Fallo ora <a href = "registrazione.php">cliccando qui</a></p>
</body>
</html>
<?php
if(isset($_GET['msg_reg'])) {
    echo $_GET['msg_reg'];
    unset($_GET['msg_reg']);
}
?>
