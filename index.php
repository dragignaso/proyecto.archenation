<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>Archenation</title>
</head>
<body>
	<a href="signinform.html">Registrese aqui</a>
	<a href="loginform.html">Inicie sesión aqui</a>
	<a href="contactoform.php">Contactanos</a>

	<?php
		session_start();
		if($_SESSION['id'] == 1){
			$usuario = $_GET['usr'];
			$queryUsuario = "SELECT nombre,apaterno,amaterno FROM usuario WHERE usuario = '".$usuario."'";
			$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationclient password=archeclient") or die();

			$result = pg_query($conn, $queryUsuario) or die (pg_last_error());

			$row = pg_fetch_row($result);

			$nombreUsr = $row[0];
			$aPaternoUsr = $row[1];
			$aMaternoUsr = $row[2];
			echo "Bienvenido ".$nombreUsr." ".$aPaternoUsr." ".$aMaternoUsr;
		}else{
			if($_SESSION['id'] == 99){
			$usuario = $_GET['usr'];
			$queryUsuario = "SELECT nombre,apaterno,amaterno FROM usuario WHERE usuario = '".$usuario."'";
			$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationclient password=archeclient") or die();

			$result = pg_query($conn, $queryUsuario) or die (pg_last_error());

			$row = pg_fetch_row($result);

			$nombreUsr = $row[0];
			$aPaternoUsr = $row[1];
			$aMaternoUsr = $row[2];
			echo "Bienvenido ".$nombreUsr." ".$aPaternoUsr." ".$aMaternoUsr;
			echo "Modo Admin";
			}
		}
		session_destroy();
	?>
</body>
</html>