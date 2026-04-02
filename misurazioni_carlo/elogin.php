<?php
	include("connessione.php");
	session_start();
	if(isset($_SESSION['idMedico']))
	   header("Location:misurazioni.php");
	else{
		if(!empty($_POST['login']) && !empty($_POST['passw'])){
			$loginM=$_POST['login'];
			$passwM=$_POST['passw'];
			$sql="SELECT * FROM medici WHERE username='$loginM' AND password='$passwM'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				$_SESSION['idMedico']=$row['id'];
				header("Location:misurazioni.php");				
			}
			else
				header("Location:login.php?msg=Credenziali errate");
		}//Fine if !empty
		else{
			header("Location:login.php?msg=Mancano dei campi!");
		}
	}

?>
