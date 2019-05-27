<?php
	session_start();
	if($_SESSION['id'] == 99){
		$campo = $_POST['campo'];
		$busqueda = $_POST['busqueda'];
		if($campo == 'idUsuario'){
			$querysearch = "SELECT * FROM usuario WHERE ".$campo." = ".$busqueda;
		}else{
			$querysearch = "SELECT * FROM usuario WHERE ".$campo." = '".$busqueda."'";
		}
		
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $querysearch) or die (pg_last_error());

		$row = pg_fetch_row($result);

		$activo = $row[10];

		if($activo == 't'){
			$activo = 'Activo';
		}else{
			$activo = 'Baja';
		}
		$idUsuario = $row[0];
		$usuario = $row[1];
		$nombre = $row[3];
		$aPaterno = $row[4];
		$aMaterno = $row[5];
		$telefono =$row[6];
		$email = $row[7];
		$direccion = $row[8];
		$rol = $row[9];

		if($rol == 'c'){
			$rol = 'Cliente';
		}else{
			$rol = 'Administrador';
		}
		$sesionusr = $_SESSION['usr'];

		if($idUsuario > 0){
				echo '
					<!DOCTYPE html>
					<html>
					<head>
						<title>Baja Usuario</title>
						<meta charset="UTF-8">
					</head>
					<body>
						<table>
						<tr>
						<td>IDUsuario</td>
						<td>Usuario</td>
						<td>Nombre</td>
						<td>APaterno</td>
						<td>AMaterno</td>
						<td>Teléfono</td>
						<td>E-Mail</td>
						<td>Dirección</td>
						<td>Tipo</td>
						<td>Estatus</td>
						</tr>
						<tr>
						<td>'.$idUsuario.'</td>
						<td>'.$usuario.'</td>
						<td>'.$nombre.'</td>
						<td>'.$aPaterno.'</td>
						<td>'.$aMaterno.'</td>
						<td>'.$telefono.'</td>
						<td>'.$email.'</td>
						<td>'.$direccion.'</td>
						<td>'.$rol.'</td>
						<td>'.$activo.'</td>
						</tr>
						</table>
						<p>Selecciona los campos que deseas modificar</p>
						<form name="modificarsuario" action="modUsr.php?usr='.$usuario.'" method="post">
							<label><input type="checkbox" name="passwordconf" value = "on">Contraseña: </label><br>
							<input type="password" name="password"><br />

							<label><input type="checkbox" name="nombreconf" value = "on">Nombre: </label><br>
							<input type="text" name="nombre"><br />

							<label><input type="checkbox" name="apaternoconf" value = "on">Apellido Paterno: </label><br>
							<input type="text" name="apaterno"><br />

							<label><input type="checkbox" name="amaternoconf" value = "on">Apellido Materno: </label><br>
							<input type="text" name="amaterno"><br />

							<label><input type="checkbox" name="telefonoconf" value = "on">Teléfono: </label><br>
							<input type="tel" name="telefono"><br />

							<label><input type="checkbox" name="emailconf" value = "on">E-Mail: </label><br>
							<input type="email" name="correoe"><br />

							<label><input type="checkbox" name="direccionconf" value = "on">Dirección: </label><br>
							<input type="text" name="direccion"><br />
				';
				if($activo == 'Baja'){
					echo '
							<label><input type="checkbox" name="activo" value = "t">Activar Cuenta</label><br>

							<input type="submit" name="submit">
						</form>
						<a href = "gestionusuarios.php">Regresar</a>
					</body>
					</html>
					';
				}else{
					echo '
							<input type="submit" name="submit">
						</form>
						<a href = "gestionusuarios.php">Regresar</a>
					</body>
					</html>
					';
				}
		}else{
			echo '
				<!DOCTYPE html>
				<html>
				<head>
					<title>Baja Usuario</title>
					<meta charset="UTF-8">
				</head>
				<body>
					<p>No se encontro al usuario con '.$campo.' = '.$busqueda.'</p>
					<a href = "gestionusuarios.php">Regresar</a>
				</body>
				</html>
			';
		}
	}else{
		header('Location: index.php');
	}
	pg_close($conn);
?>