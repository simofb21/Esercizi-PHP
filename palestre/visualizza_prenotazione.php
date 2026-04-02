<?php
    session_start();
    include "connessione.php";
    if(!isset($_SESSION['id_abbonamento'])){
        header("Location: login.php");
        exit();
    }
    $id_abbonamento = $_SESSION['id_abbonamento'];

    $result = mysqli_query($conn,"
    SELECT data_prenotazione, Attivita.nome,Palestra.nome AS nome_palestra
    FROM Prenotazione
    JOIN Corsi ON Prenotazione.id_corso = Corsi.id_corso
    JOIN Attivita ON Corsi.id_attivita = Attivita.id_attivita
    JOIN Palestra ON Corsi.id_palestra = Palestra.id_palestra
    WHERE id_abbonamento = $id_abbonamento
    ");
    ?>

    <html>
        <head>
        <title>Le mie prenotazioni</title>
        </head>

            <body>

            <h1>Le mie prenotazioni</h1>

            <a href="prenotazione.php">Prenota corso</a> |
            <a href="logout.php">Logout</a>

            <br><br>

            <table b    order="1">

            <tr>
            <th>Data</th>
            <th>Attività</th>
            <th>Palestra</th>
            </tr>

            <?php
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['data_prenotazione']."</td>";
                    echo "<td>".$row['nome']."</td>";
                    echo "<td>".$row['nome_palestra']."</td>";
                    echo "</tr>";
                }
            ?>

    </table>

    </body>
    </html>
