<?php
	$usuario = $_POST['usuario'];
	$nombre = $_POST['nombre'];
	$apaterno = $_POST['apaterno'];
	$amaterno = $_POST['amaterno'];
	$correoe = $_POST['correoe'];
	$telefono = $_POST['telefono'];
	$direccion = $_POST['direccion'];
	$password = md5($_POST['password']);
	$confpassword = md5($_POST['confpassword']);
	$queryindex = "SELECT COUNT(idUsuario) FROM usuarios";
	$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationclient password=archeclient") or die();

	//$result pg_query($conn, $queryindex) or die (pg_last_error());

	//pg_close($conn);

	//$idusuario = $result + 1;
	$queryalta = "INSERT INTO usuario (idUsuario,usuario,password,nombre,apaterno,amaterno,telefono,email,direccion,rol,activo) VALUES(1,'".$usuario."','".$password."','".$nombre."','".$apaterno."','".$amaterno."','".$telefono."','".$correoe."','".$direccion."','c','t')";

	if ($password != $confpassword) {
		header('Location: signinform.html');
	}else{
		pg_query($conn,$queryalta) or die(pg_last_error());
		pg_close($conn);

		echo 'El PASSWORD ES IGUAL';
	}
?>