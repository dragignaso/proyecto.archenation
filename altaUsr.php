<?php
	session_start();
		if($_SESSION['id'] == 99){
		$usuario = $_POST['usuario'];
		$nombre = $_POST['nombre'];
		$apaterno = $_POST['apaterno'];
		$amaterno = $_POST['amaterno'];
		$correoe = $_POST['correoe'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$password = md5($_POST['password']);
		$confpassword = md5($_POST['confpassword']);
		$rol = $_POST['rol'];
		$queryindex = "SELECT MAX(idUsuario) FROM usuario";
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $queryindex) or die (pg_last_error());

		$row = pg_fetch_row($result);

		$idUsuario = $row[0] + 1;

		$idUsuario = (string)$idUsuario;
		
		$queryalta = "INSERT INTO usuario(idUsuario,usuario,password,nombre,apaterno,amaterno,telefono,email,direccion,rol,activo) VALUES(".$idUsuario.",'".$usuario."','".$password."','".$nombre."','".$apaterno."','".$amaterno."','".$telefono."','".$correoe."','".$direccion."','".$rol."','t')";

		if ($password != $confpassword) {
			echo "Hubo un error en sus datos por favor verifique que: \n\n 1.-La contraseña y su confirmación son iguales\n2.-";
			sleep(10);
			header('Location: altaUsrF.php');
		}else{
			pg_query($conn,$queryalta) or die (pg_last_error());
			pg_close($conn);
			echo "Su registro se cumplio satisfactoriamente.\nRedirigiendolo a la pagina principal";
			header('Location: gestionusuarios.php');
		}
	}else{
		header('Location: index.php');
	}
?>