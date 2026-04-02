<?php
    session_start();
    include 'connessione.php';
    if(!isset($_SESSION['userID'])){
        header('Location: login.php');
        exit();
    }
    else {
        echo "<h1>" . $_SESSION['msg'] . "</h1>"; 
        $userID = $_SESSION['userID'];
        $query = "SELECT data_prenotazione as data, film.titolo as titolo, film.genere as genere, film.prezzo as p from prenotazioni 
        INNER JOIN film on film.id_film=prenotazioni.id_film INNER JOIN utenti on utenti.id = prenotazioni.id_utente 
        WHERE utenti.id = ". $_SESSION['userID'] ;

        $result = mysqli_query($conn,$query);
        $out = "<table> <tr><th>Titolo</th> <th>Genere</th> <th>Prezzo</th> <th>Data prenotazione</th></tr>";
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result))
                $out .= "<tr>". "<td>" . $row['titolo'] ."</td> <td>".$row['genere']."</td> <td>".$row['p']."</td> <td>".$row['data'] . "</tr>";
            
            $out.= "</table>";
        }else{
            $out =  "Nessuna prenotazione effettuata.";
        }
        echo $out;

    }
?>
<br>
<a href="logout.php">Vai al logout</a>