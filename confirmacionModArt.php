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
		if($activo == 't'){
			$activo = 'Activo';
		}else{
			$activo = 'Baja';
		}
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
						<td>IDArticulo</td>
						<td>Nombre</td>
						<td>Descripción</td>
						<td>Precio</td>
						<td>Cantidad</td>
						<td>Descuento</td>
						<td>% Descuento</td>
						<td>Activo</td>
						</tr>
						<tr>
						<td>'.$idArticulo.'</td>
						<td>'.$nombre.'</td>
						<td>'.$descripcion.'</td>
						<td>'.$precio.'</td>
						<td>'.$cantidad.'</td>
						<td>'.$enDescuento.'</td>
						<td>'.$porcentajeDescuento.'</td>
						<td>'.$activo.'</td>
						</tr>
						</table>
						<p>Selecciona los campos que deseas modificar</p>
						<form name="modificararticulo" action="modArt.php?usr='.$idArticulo.'" method="post">
							<label><input type="checkbox" name="nombreconf" value = "on">Nombre: </label><br>
							<input type="text" name="nombre"><br />

							<label><input type="checkbox" name="descripcionconf" value = "on">Descripción: </label><br>
							<input type="text" name="descripcion"><br />

							<label><input type="checkbox" name="imagenconf" value = "on">Imagen: </label><br>
							<input type="file" name="imagen"><br />

							<label><input type="checkbox" name="precioconf" value = "on">Precio: </label><br>
							<input type="text" name="precio"><br />

							<label><input type="checkbox" name="cantidadconf" value = "on">Cantidad: </label><br>
							<input type="text" name="cantidad"><br />

							<label><input type="checkbox" name="endescuento" value = "t">Aplicar Descuento</label><br>

							<label><input type="checkbox" name="cantidaddescuentoconf" value = "on">Descuento(%): </label><br>
							<input type="text" name="cantidaddescuento"><br />
				';
				if($activo == 'Baja'){
					echo '
							<label><input type="checkbox" name="activo" value = "t">Activar Artículo</label><br>

							<input type="submit" name="submit">
						</form>
						<a href = "gestionarticulos.php">Regresar</a>
					</body>
					</html>
					';
				}else{
					echo '
							<input type="submit" name="submit">
						</form>
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