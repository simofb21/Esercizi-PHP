<!DOCTYPE html>
<html>

<head>
<title>Login</title>
</head>

<body>
	<form name="accessoM" action="elogin.php" method="post">
		<fieldset>
			<legend>Accesso database misurazioni</legend>
			Login: <input name="login" type="text" />
			Password: <input name="passw" type="password" />
			<p> <input type="reset" value="Cancella">
				<input type="submit" value="Invia"></p>
			<p>
				<?php
					if(isset($_REQUEST['msg']))
						echo $_REQUEST['msg'];
				?>
			</p>
		</fieldset>
	</form>
</body>

</html>
