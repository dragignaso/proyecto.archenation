<?php
	session_start();
		if($_SESSION['id'] == 99){
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$imagen = $_FILES['imagen']['name'];
		$precio = $_POST['precio'];
		$cantidad = $_POST['cantidad'];
		$endescuento = $_POST['endescuento'];
		$porcentajedescuento = $_POST['porcentajedescuento'];

		echo ''.$cantidad.''.$precio;


		$queryindex = "SELECT MAX(idArticulo) FROM articulo";
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $queryindex) or die (pg_last_error());

		$row = pg_fetch_row($result);

		$idArticulo = $row[0] + 1;

		$idArticulo = (string)$idArticulo;
		
		if($endescuento == t){
			$queryalta = "INSERT INTO articulo(idArticulo,nombre,descripcion,imagen,precio,cantidad,enDescuento,porcentajeDescuento,activo) VALUES(".$idArticulo.",'".$nombre."','".$descripcion."','".$imagen."',".$precio.",".$cantidad.",'".$endescuento."',".$porcentajedescuento.",'t')";
		}else{
			$queryalta = "INSERT INTO articulo(idArticulo,nombre,descripcion,imagen,precio,cantidad,enDescuento,porcentajeDescuento,activo) VALUES(".$idArticulo.",'".$nombre."','".$descripcion."','".$imagen."',".$precio.",".$cantidad.",'f',0,'t')";
		}
		
		pg_query($conn,$queryalta) or die (pg_last_error());
		pg_close($conn);

		$target_path = "img/articulos/";
		$target_path = $target_path . basename( $_FILES['imagen']['name']); 
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) {
		    echo "El archivo ".  basename( $_FILES['imagen']['name']). 
		    " ha sido subido";
		} else{
		    echo "Ha ocurrido un error, trate de nuevo!";
		}
		
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Alta Articulo</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>El artículo fue dado de alta correctamente</p>
				<a href = "gestionarticulos.php">Regresar</a>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
?>