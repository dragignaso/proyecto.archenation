<?php
	session_start();
	if($_SESSION['id'] == 99){
		$usuario = $_GET['usr'];
		$npassword = md5($_POST['password']);
		$nnombre = $_POST['nombre'];
		$napaterno = $_POST['apaterno'];
		$namaterno = $_POST['amaterno'];
		$ntelefono = $_POST['telefono'];
		$ncorreoe = $_POST['correoe'];
		$ndireccion = $_POST['direccion'];
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		if($_POST['passwordconf'] == 'on'){
			$querymod = "UPDATE usuario SET password = '".$npassword."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['nombreconf'] == 'on'){
			$querymod = "UPDATE usuario SET nombre = '".$nnombre."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['apaternoconf'] == 'on'){
			$querymod = "UPDATE usuario SET aPaterno = '".$napaterno."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['amaternoconf'] == 'on'){
			$querymod = "UPDATE usuario SET aMaterno = '".$namaterno."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['telefonoconf'] == 'on'){
			$querymod = "UPDATE usuario SET telefono = '".$ntelefono."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['emailconf'] == 'on'){
			$querymod = "UPDATE usuario SET email = '".$ncorreoe."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['direccionconf'] == 'on'){
			$querymod = "UPDATE usuario SET direccion = '".$ndireccion."' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['activo'] == 't'){
			$querymod = "UPDATE usuario SET activo = 't' WHERE usuario = '".$usuario."'";
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}


		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Modificación de usuario</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>El usuario se actualizó correctamente</p>
				<a href = "gestionusuarios.php">Regresar</a>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	pg_close($conn);
?>