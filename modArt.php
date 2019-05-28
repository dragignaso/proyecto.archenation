<?php
	session_start();
	if($_SESSION['id'] == 99){
		$idArticulo = $_GET['usr'];
		$nnombre = $_POST['nombre'];
		$ndescripcion = $_POST['descripcion'];
		$nimagen = $_FILES['imagen']['name'];
		$nprecio = $_POST['precio'];
		$ncantidad = $_POST['cantidad'];
		$nendescuento = $_POST['endescuento'];
		$ncantidaddescuento = $_POST['cantidaddescuento'];
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		if($_POST['nombreconf'] == 'on'){
			$querymod = "UPDATE articulo SET nombre = '".$nnombre."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['descripcionconf'] == 'on'){
			$querymod = "UPDATE articulo SET descripcion = '".$ndescripcion."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['imagenconf'] == 'on'){
			$querymod = "UPDATE articulo SET imagen = '".$nimagen."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

			$target_path = "img/articulos/";
			$target_path = $target_path . basename( $_FILES['imagen']['name']); 
			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) {
			    echo "El archivo ".  basename( $_FILES['imagen']['name']). 
			    " ha sido subido";
			} else{
			    echo "Ha ocurrido un error, trate de nuevo!";
			}
		}
		if($_POST['precioconf'] == 'on'){
			$querymod = "UPDATE articulo SET precio = '".$nprecio."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['cantidadconf'] == 'on'){
			$querymod = "UPDATE articulo SET cantidad = '".$ncantidad."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['endescuento'] == 't' && $_POST['cantidaddescuentoconf'] == 'on'){
			$querymod = "UPDATE articulo SET enDescuento = 't' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());
			$querymod = "UPDATE articulo SET  porcentajeDescuento = '".$ncantidaddescuento."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['endescuento'] != 't' && $_POST['cantidaddescuentoconf'] == 'on'){
			$querymod = "UPDATE articulo SET  porcentajeDescuento = '".$ncantidaddescuento."' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}
		if($_POST['activo'] == 't'){
			$querymod = "UPDATE articulo SET activo = 't' WHERE idArticulo = ".$idArticulo;
			$result = pg_query($conn, $querymod) or die (pg_last_error());

		}



		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Modificación de Artículo</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>El artículo se actualizó correctamente</p>
				<a href = "gestionarticulos.php">Regresar</a>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	pg_close($conn);
?>