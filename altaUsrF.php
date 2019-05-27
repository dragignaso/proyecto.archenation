<?php
	session_start();
	if($_SESSION['id'] == 99){
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>SignIn</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>Ingrese los siguientes datos</p>
				<form name="nuevousuario" action="altaUsr.php" method="post">
					<label for="usuario">Usuario: </label>
					<input type="text" name="usuario"><br />
					<label for="nombre">Nombre: </label>
					<input type="text" name="nombre"><br />
					<label for="apaterno">Apellido Paterno: </label>
					<input type="text" name="apaterno"><br />
					<label for="amaterno">Apellido Materno: </label>
					<input type="text" name="amaterno"><br />
					<label for="correoe">Correo electrónico: </label>
					<input type="email" name="correoe"><br />
					<label for="telefono">Teléfono: </label>
					<input type="text" name="telefono"><br />
					<label for="direccion">Dirección: </label>
					<input type="text" name="direccion"><br />
					<label for="password">Contraseña: </label>
					<input type="password" name="password"><br />
					<label for="confpassword">Confirmar Contraseña: </label>
					<input type="password" name="confpassword"><br />
					<label for="rol">Permisos: </label>
					<select name="rol">
						<option value="c">Cliente</option>
						<option value="a">Administrador</option>
					</select>
					<input type="submit" name="submit">
				</form>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	
?>