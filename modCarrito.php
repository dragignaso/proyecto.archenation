<?php
	session_start();
	if($_SESSION['id'] != 1){
		header('Location: index.php');
	}else{
		$idArticulo = $_POST['idarticulo'];
		$idVenta = $_POST['idventa'];

		$querycliente = "DELETE FROM contenidoVenta WHERE idVenta = ".$idVenta."AND idArticulo = ".$idArticulo;
		$queryconscontventa = "SELECT cantidad,precioFinal FROM contenidoVenta WHERE idVenta = ".$idVenta."AND idArticulo = ".$idArticulo;
        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();
        $result = pg_query($conn, $queryconscontventa) or die (pg_last_error());
        $row = pg_fetch_row($result);
        $cantidad = $row[0];
        $precioFinal = $row[1];
        $descuento = $cantidad * $precioFinal;

        echo ''.$cantidad."/".$precioFinal."/".$descuento;

        $queryconstotventa = "SELECT totalVenta FROM venta WHERE idVenta = ".$idVenta;
        $result = pg_query($conn, $queryconscontventa) or die (pg_last_error());
        $row = pg_fetch_row($result);
        $totalActual = $row[0];

        echo ''.$totalActual;

        $descuento = $totalActual - $descuento;

        $querymodventa = "UPDATE venta SET totalVenta = ".$descuento." WHERE idVenta = ".$idVenta;
        $result = pg_query($conn, $querymodventa) or die (pg_last_error());

        $result = pg_query($conn, $querycliente) or die (pg_last_error());


        //header("Location: carrito.php");
	}

?>