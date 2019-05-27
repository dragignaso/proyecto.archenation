<?php
	session_start();
	if($_SESSION['id'] == 99){
		$usuario = $_GET['usr'];
		$querybaja = "UPDATE usuario SET activo = 'f' WHERE usuario = '".$usuario."'";
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $querybaja) or die (pg_last_error());
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>SignIn</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>El usuario fue dado de baja correctamente</p>
				<a href = "gestionusuarios.php">Regresar</a>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	pg_close($conn);
?>