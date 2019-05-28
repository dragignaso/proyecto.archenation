<?php
	session_start();
	if($_SESSION['id'] == 99){
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Baja Artículo</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>Ingrese los parametros de busqueda</p>
				<form name="bajaarticulo" action="confirmacionBajaArt.php" method="post">
					<label for="campo">Campo: </label>
					<select name="campo">
						<option value="idArticulo">ID Artículo</option>
						<option value="nombre">Nombre</option>
					</select>
					<label for="busqueda">Información: </label>
					<input type="text" name="busqueda"><br />
					<input type="submit" name="submit">
				</form>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	
?>