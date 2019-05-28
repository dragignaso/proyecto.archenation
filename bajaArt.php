<?php
	session_start();
	if($_SESSION['id'] == 99){
		$articulo = $_GET['usr'];
		$querybaja = "UPDATE articulo SET activo = 'f' WHERE idArticulo = ".$articulo;
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $querybaja) or die (pg_last_error());
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Baja artículo</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>El articulo fue dado de baja correctamente</p>
				<a href = "gestionarticulos.php">Regresar</a>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	pg_close($conn);
?>