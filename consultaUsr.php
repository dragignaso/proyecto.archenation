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
						<title>Consulta Usuario</title>
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
						<a href = "gestionusuarios.php">Regresar</a>
					</body>
					</html>
				';
		}else{
			echo '
				<!DOCTYPE html>
				<html>
				<head>
					<title>Baja Usuario</title>
					<meta charset="UTF-8">
				</head>
				<body>
					<p>No se encontro al usuario con '.$campo.': '.$busqueda.'</p>
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