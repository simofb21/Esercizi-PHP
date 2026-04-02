<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina registrazione | Progetto palestra</title>
</head>
<body>
    <form action="register.php" method="POST">
    <h1>Registrazione</h1>
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>
    <label for="cognome">Cognome:</label><br>
    <input type="text" id="cognome" name="cognome" required><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <label for="data_nascita">Data di nascita:</label><br>
    <input type="date" id="data_nascita" name="data_nascita" required><br><br>
    <input type="submit">
    <input type="reset" value="Reset">
    </form>
</body>
</html>