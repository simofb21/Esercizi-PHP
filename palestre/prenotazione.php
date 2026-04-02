<?php
    session_start();
    include "connessione.php";
    if(!isset($_SESSION['id_abbonamento'])){
        header("Location: login.php");
        exit();
    }
?>
<html>
    <head>
    <title>Prenota corso</title>
    </head>

    <body>

    <h1>Prenota un corso</h1>

    <p>Benvenuto <?php echo $_SESSION['nome']; ?></p>

    <a href="visualizza_prenotazione.php">Le mie prenotazioni</a> |
    <a href="logout.php">Logout</a>

    <br><br>

    <form method="POST">

    Seleziona palestra:

    <select name="palestra">

    <?php
    $result = mysqli_query($conn,"SELECT * FROM Palestra");

    while($row = mysqli_fetch_assoc($result)){
        echo "<option value='{$row['id_palestra']}'>{$row['nome']}</option>";
    }
    ?>

    </select>

    <input type="submit" value="Mostra corsi">

    </form>

    <br>

    <?php

    if(isset($_POST['palestra'])){

    $id_palestra = $_POST['palestra'];

    $result = mysqli_query($conn,"
    SELECT id_corso, Attivita.nome
    FROM Corsi
    JOIN Attivita ON Corsi.id_attivita = Attivita.id_attivita
    WHERE id_palestra = $id_palestra AND num_posti > 0
    ");

    echo "<form action='conferma_prenotazione.php' method='POST'>";

    echo "<select name='corso'>";

    while($row = mysqli_fetch_assoc($result)){
        echo "<option value='{$row['id_corso']}'>{$row['nome']}</option>";
    }

    echo "</select>";

    echo "<br><br><input type='submit' value='Prenota'>";
    echo "</form>";

    }
    ?>

    </body>
</html>
