<?php
	session_start();
	if($_SESSION['id'] == 99){
		$campo = $_POST['campo'];
		$busqueda = $_POST['busqueda'];
		if($campo == 'idArticulo'){
			$querysearch = "SELECT * FROM articulo WHERE ".$campo." = ".$busqueda;
		}else{
			$querysearch = "SELECT * FROM articulo WHERE ".$campo." = '".$busqueda."'";
		}
		
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $querysearch) or die (pg_last_error());

		$row = pg_fetch_row($result);

		$activo = $row[8];
		$idArticulo = $row[0];
		$nombre = $row[1];
		$descripcion = $row[2];
		$precio = $row[4];
		$cantidad = $row[5];
		$enDescuento =$row[6];
		if($enDescuento == 't'){
			$enDescuento = 'Con Descuento';
		}else{
			$enDescuento = 'Sin Descuento';
		}
		$porcentajeDescuento = $row[7];

		if($idArticulo > 0){
			if($activo == 't'){
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
						<td>IDArticulo</td>
						<td>Nombre</td>
						<td>Descripción</td>
						<td>Precio</td>
						<td>Cantidad</td>
						<td>Descuento</td>
						<td>% Descuento</td>
						</tr>
						<tr>
						<td>'.$idArticulo.'</td>
						<td>'.$nombre.'</td>
						<td>'.$descripcion.'</td>
						<td>'.$precio.'</td>
						<td>'.$cantidad.'</td>
						<td>'.$enDescuento.'</td>
						<td>'.$porcentajeDescuento.'</td>
						</tr>
						</table>
						<p>¿Esta desea dar de baja este artículo?</p>
						<a href = "bajaArt.php?usr='.$idArticulo.'">Confirmar Baja</a>
						<a href = "gestionarticulos.php">Cancelar</a>
					</body>
					</html>
				';
			}else{
				echo '
					<!DOCTYPE html>
					<html>
					<head>
						<title>Baja Artículo</title>
						<meta charset="UTF-8">
					</head>
					<body>
						<p>El artículo con '.$campo.': '.$busqueda.' ya se encuentra dado de baja</p>
						<a href = "gestionarticulos.php">Regresar</a>
					</body>
					</html>
				';
			}
		}else{
			echo '
				<!DOCTYPE html>
				<html>
				<head>
					<title>Baja Artículo</title>
					<meta charset="UTF-8">
				</head>
				<body>
					<p>No se encontro el artículo con '.$campo.' = '.$busqueda.'</p>
					<a href = "gestionarticulos.php">Regresar</a>
				</body>
				</html>
			';
		}
	}else{
		header('Location: index.php');
	}
	pg_close($conn);
?>