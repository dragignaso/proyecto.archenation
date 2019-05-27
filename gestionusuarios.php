<?php
	session_start();

	if($_SESSION['id'] == 99){
		echo'
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
			</head>
			<body>
				<a href="altaUsrF.php">Nuevo Usuario</a>
				<a href="bajaUsrF.php">Baja Usuario</a>
				<a href="modificarUsrF.php">Modificar Usuario</a>
				<a href="consultaUsrF.php">Consultar Usuario</a>
			</body>
			</html>
		';
	}else{
		session_destroy();
		header('Location: index.php');
	}
?>