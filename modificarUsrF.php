<?php
	session_start();
	if($_SESSION['id'] == 99){
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Modificar Usuario</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>Ingrese los parametros de busqueda</p>
				<form name="modificarsuario" action="confirmacionModUsr.php" method="post">
					<label for="campo">Campo: </label>
					<select name="campo">
						<option value="usuario">Usuario</option>
						<option value="email">Correo Electrónico</option>
						<option value="idUsuario">ID de usuario</option>
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