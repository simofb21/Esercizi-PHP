<html>
<head>
    <title>Elenco Misurazioni</title>
</head>
<body>
    <?php
        session_start();
        // controllo di sicurezza: se non c'è sessione, rimando al login
        if(!isset($_SESSION['idMedico'])){
            header("Location:login.php?msg=Per accedere bisogna prima loggarsi");
            exit;
        }

        // controllo se arrivano i dati dal form
        if(isset($_POST['paziente']) && isset($_POST['data1']) && isset($_POST['data2'])) {
            
            include("connessione.php");

            $idpaziente = $_POST['paziente'];
            $d1 = $_POST["data1"];
            $d2 = $_POST["data2"];

            // query dati paziente
            $sql = "SELECT id, nomecognome, sesso, dnascita FROM pazienti WHERE id=$idpaziente";
            $result = mysqli_query($conn, $sql);
            
            // verifico se il paziente esiste
            if($row = mysqli_fetch_array($result)){
                $datanascita = date("d-m-Y", strtotime($row['dnascita']));
                
                echo "<h2>Paziente: ". $row['nomecognome']."</h2>
                      Sesso: ". $row['sesso']."<br>
                      Data di nascita: $datanascita<br>";
                
                echo "Intervallo temporale: ". date('d-m-Y', strtotime($d1))." / ".date('d-m-Y', strtotime($d2))."<br><br>";

                // query misurazioni
                $sqlMis = "SELECT data_ora, parametro, valorerilevato
                            FROM misurazioni 
                            WHERE idpaziente=$idpaziente 
                            AND data_ora BETWEEN '$d1' AND '$d2' 
                            ORDER BY data_ora";
                
                $resultMis = mysqli_query($conn, $sqlMis);

                if(mysqli_num_rows($resultMis) == 0){
                    echo "<br/>Nessuna misurazione trovata nel periodo selezionato.<br/><br/>";
                }
                else{
                    echo "<table border='1'>
                            <tr>
                                <th>Data</th>
                                <th>Ora</th>
                                <th>Parametro</th>
                                <th>Valore</th>
                            </tr>";
                    
                    while($rowMis = mysqli_fetch_assoc($resultMis)){
                        $do = $rowMis['data_ora'];
                        $d = date('d-m-Y', strtotime($do));
                        $o = date('H:i:s', strtotime($do));
                        
                        echo "<tr>";
                        echo "<td>$d</td>";
                        echo "<td>$o</td>";
                        echo "<td>".$rowMis['parametro']."</td>";
                        echo "<td>".$rowMis['valorerilevato']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br/>";
                }
            } else {
                echo "Errore: Paziente non trovato o non selezionato.<br>";
            }

            mysqli_close($conn);

        } else {
            // se provo ad accedere alla pagina senza passare dal form
            echo "Accesso non valido. Passare dalla pagina di ricerca.<br>";
        }
    ?>

    <br>
    <a href='misurazioni.php'>cerca nuovo paziente</a><br><br>
    <a href='logout.php'>esci dalla sessione</a>

</body>
</html>