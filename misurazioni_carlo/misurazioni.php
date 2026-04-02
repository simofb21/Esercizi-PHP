<html>
<head>
    <title>Misurazioni - Selezione</title>
</head>
<body>
    <?php
        session_start();
        // controllo se l'utente è loggato
        if(!isset($_SESSION['idMedico'])){
            header("Location:login.php?msg=Per accedere bisogna prima loggarsi");
            exit;
        }
        
        include("connessione.php");
        
        $idmedico = $_SESSION['idMedico']; 

        // recupero nome del medico
        $sql = "SELECT nomecognome FROM medici WHERE id=$idmedico";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        
        echo "<h2>Dott. ". $row['nomecognome']." <br>Monitoraggio misurazioni a distanza <br></h2>
              <h3>Misurazioni per paziente</h3>";
    ?>
    <form id="misura" method="post" action="ccelenco_misurazioni.php">
        <br><br>
        <label>Paziente</label><br>
        <select name="paziente" id="paziente">
            <option value="">Seleziona</option>
            <?php
                $sql = "SELECT id, nomecognome FROM pazienti WHERE idmedico=$idmedico ORDER BY nomecognome";
                $result = mysqli_query($conn, $sql);
                
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['id']."'>".$row['nomecognome']."</option>";
                    }
                }
            ?>
        </select><br><br>
        
        Dal:<input type="date" name="data1" required>
        Al: <input type="date" name="data2" required><br><br>
        
        <input type='reset' id="reset" value='Cancella'>
        <input type='submit' id="invia" value='Visualizza misurazioni'>
    </form>
    
    <br>
    <a href='logout.php'>Esci dalla sessione</a>
    
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>