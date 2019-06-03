<?php
	session_start();
	if($_SESSION['id'] == 1){
		$usuario = $_SESSION['usr'];
		$cantidad = $_POST['cantidad'];
		$idArticulo = $_POST['idarticulo'];

		$queryarticulo = 'SELECT * FROM articulo WHERE idArticulo = '.$idArticulo;
		$querycliente = "SELECT IdUsuario FROM usuario WHERE usuario = '".$usuario."'";
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

		$result = pg_query($conn, $queryarticulo) or die (pg_last_error());
        $row = pg_fetch_row($result);

        $cantidadArt = $row[5];
        $precioArt = $row[4];
        $enDescuentoArt = $row[6];
        $cantDescuentoArt = $row[7];
        if($enDescuentoArt == 't'){
        	$totalVenta = ($precioArt * ((100 - $cantDescuentoArt)/100))*$cantidad;
        }else{
        	$totalVenta = $precioArt * $cantidad;
        }

        $result = pg_query($conn, $querycliente) or die (pg_last_error());
        $row = pg_fetch_row($result);

        $idUsuario = $row[0];
        $timestamp = date('Y-m-d G:i:s');

        $querybusquedacarrito = "SELECT idVenta,totalVenta FROM venta WHERE idUsuario = ".$idUsuario." AND status = 'p'";
        $result = pg_query($conn, $querybusquedacarrito) or die (pg_last_error());
        $row = pg_fetch_row($result);
        $idCarrito = $row[0];
        $totalActualVenta = $row[1];

        if($idCarrito > 0 && $cantidadArt > 0){

                $querycompartcarr = "SELECT cantidad FROM contenidoVenta WHERE idArticulo = ".$idArticulo." AND idVenta = ".$idCarrito;
                $result = pg_query($conn, $querycompartcarr) or die (pg_last_error());
                $row = pg_fetch_row($result);
                $cantidadsiexiste = $row[0];

                if(($cantidadsiexiste + $cantidad) <= $cantidadArt ){
                      if($cantidadsiexiste > 0){
                                if($enDescuentoArt == 't'){
                                        $precioFInal = $precioArt * ((100 - $cantDescuentoArt)/100);
                                        $cantidadsiexiste = $cantidad + $cantidadsiexiste;

                                        $queryagregar = "UPDATE contenidoVenta SET cantidad = ".$cantidadsiexiste." WHERE idVenta = ".$idCarrito." AND idArticulo =".$idArticulo;
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());

                                        $totalActualVenta = $totalActualVenta + $totalVenta;
                                        $queryactualizartotal = "UPDATE venta SET totalVenta = ".$totalActualVenta." WHERE idVenta = ".$idCarrito;
                                        $result = pg_query($conn, $queryactualizartotal) or die (pg_last_error());
                                }else{
                                        $cantidadsiexiste = $cantidad + $cantidadsiexiste;

                                        $queryagregar = "UPDATE contenidoVenta SET cantidad = ".$cantidadsiexiste." WHERE idVenta = ".$idCarrito." AND idArticulo =".$idArticulo;
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());

                                        $totalActualVenta = $totalActualVenta + $totalVenta;
                                        $queryactualizartotal = "UPDATE venta SET totalVenta = ".$totalActualVenta."WHERE idVenta = ".$idCarrito;
                                        $result = pg_query($conn, $queryactualizartotal) or die (pg_last_error());

                                }        
                        }else{
                                if($enDescuentoArt == 't'){
                                        $precioFInal = $precioArt * ((100 - $cantDescuentoArt)/100);
                                        echo 'el error puede estar aqui';
                                        $queryagregar = "INSERT INTO contenidoVenta VALUES(".$idCarrito.",".$idArticulo.",".$cantidad.",16.0,".$precioFInal.")";
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());

                                        $totalActualVenta = $totalActualVenta + $totalVenta;
                                        $queryactualizartotal = "UPDATE venta SET totalVenta = ".$totalActualVenta." WHERE idVenta = ".$idCarrito;
                                        $result = pg_query($conn, $queryactualizartotal) or die (pg_last_error());
                                }else{
                                        echo 'o aqui D:';
                                        $queryagregar = "INSERT INTO contenidoVenta VALUES(".$idCarrito.",".$idArticulo.",".$cantidad.",16.0,".$precioArt.")";
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());

                                        $totalActualVenta = $totalActualVenta + $totalVenta;
                                        $queryactualizartotal = "UPDATE venta SET totalVenta = ".$totalActualVenta."WHERE idVenta = ".$idCarrito;
                                        $result = pg_query($conn, $queryactualizartotal) or die (pg_last_error());

                                }         
                        }  
                }
                
        }else{
                if($cantidad <= $cantidadArt){
                        $queryindex = "SELECT MAX(idVenta) FROM venta";
                        $result = pg_query($conn, $queryindex) or die (pg_last_error());
                        $row = pg_fetch_row($result);
                        $ventaIndex = $row[0];

                        if($ventaIndex > 0){
                                $ventaIndex = $ventaIndex + 1;

                                echo 'incluso aqui';
                                $queryventa = "INSERT INTO venta VALUES(".$ventaIndex.",".$idUsuario.",'".$timestamp."',".$totalVenta.",'p')";
                                $result = pg_query($conn, $queryventa) or die (pg_last_error());

                                if($enDescuentoArt == 't'){
                                        $precioFInal = $precioArt * ((100 - $cantDescuentoArt)/100);
                                        echo 'aqui no se si sea';
                                        $queryagregar = "INSERT INTO contenidoVenta VALUES(".$ventaIndex.",".$idArticulo.",".$cantidad.",16.0,".$precioFInal.")";
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());
                                }else{
                                        echo 'panque con pasas';
                                        $queryagregar = "INSERT INTO contenidoVenta VALUES(".$ventaIndex.",".$idArticulo.",".$cantidad.",16.0,".$precioArt.")";
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());
                                }
                        }else{
                                $ventaIndex = 1;

                                echo 'panque con nuez';
                                $queryventa = "INSERT INTO venta VALUES(".$ventaIndex.",".$idUsuario.",'".$timestamp."',".$totalVenta.",'p')";
                                $result = pg_query($conn, $queryventa) or die (pg_last_error());

                                if($enDescuentoArt == 't'){
                                        $precioFInal = $precioArt * ((100 - $cantDescuentoArt)/100);
                                        echo 'panque con pozole';
                                        $queryagregar = "INSERT INTO contenidoVenta VALUES(".$ventaIndex.",".$idArticulo.",".$cantidad.",16.0,".$precioFInal.")";
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());
                                }else{
                                        echo 'panque con tostadas';
                                        $queryagregar = "INSERT INTO contenidoVenta VALUES(".$ventaIndex.",".$idArticulo.",".$cantidad.",16.0,".$precioArt.")";
                                        $result = pg_query($conn, $queryagregar) or die (pg_last_error());
                                }
                        }    
                }
        }
        header('Location: tienda.php');
	}else{
		header('Location: index.php');
	}
	

?>