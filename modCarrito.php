<?php
	session_start();
	if($_SESSION['id'] != 1){
		header('Location: index.php');
	}else{
		$idArticulo = $_POST['idarticulo'];
		$idVenta = $_POST['idventa'];

		$querycliente = "DELETE FROM contenidoVenta WHERE idVenta = ".$idVenta."AND idArticulo = ".$idArticulo;
        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();
        $result = pg_query($conn, $querycliente) or die (pg_last_error());
        header("Location: carrito.php");
	}

?>