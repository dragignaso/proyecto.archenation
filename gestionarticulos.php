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
				<a href="altaArtF.php">Nuevo Artículo</a>
				<a href="bajaArtF.php">Baja Artículo</a>
				<a href="modificarArtF.php">Modificar Artículo</a>
				<a href="consultaArtF.php">Consultar Artículo</a>
				<a href="index.php">Menú Principal</a>
			</body>
			</html>
		';
	}else{
		session_destroy();
		header('Location: index.php');
	}
?>