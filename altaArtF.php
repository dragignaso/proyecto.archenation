<?php
	session_start();
	if($_SESSION['id'] == 99){
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Alta Ariticulo</title>
				<meta charset="UTF-8">
			</head>
			<body>
				<p>Ingrese los siguientes datos</p>
				<form name="nuevoarticulo" action="altaArt.php" method="post" enctype="multipart/form-data">
					<label for="nombre">Nombre: </label>
					<input type="text" name="nombre"><br />
					<label for="descripcion">Descripcion: </label>
					<input type="text" name="descripcion"><br />
					<label for="imagen">Imagen: </label>
					<input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif"><br />
					<label for="precio">Precio: </label>
					<input type="text" name="precio"><br />
					<label for="cantidad">Cantidad: </label>
					<input type="text" name="cantidad"><br />
					<label><input type="checkbox" name="endescuento" value = "t">Aplicar Descuento</label><br>
					<label for="porcentajedescuento">Porcentaje Descuento: </label>
					<input type="text" name="porcentajedescuento"><br />
					<input type="submit" name="submit">
				</form>
			</body>
			</html>
		';
	}else{
		header('Location: index.php');
	}
	
?>