<html>
    <head>
        <title>Pagina di registrazione</title>
        <style>
            body{
                text-align:center;     
            }
        </style>
    </head>
    <body>
        <h1>Crea un nuovo account</h1>

        <form method="post" action ="eregistrati.php">

            <label for = "nome" >Nome: </label>
            <input type="text" id="nome" name="nome" required>
            <br><br>
            <label for = "email"> Email : </label>
            <input type="email"  id="email" name="email" required>
            <br><br>
            <label for = "password"> Password : </label>
            <input type="password"  id="password" name="password" required>
            <br><br>
            <input type="submit" value="Registrati">
        </form>

        <p>Hai già un account ? <a href="login.php">Accedi</a></p>
    </body>
</html>