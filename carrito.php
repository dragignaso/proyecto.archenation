<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tienda virtual Archenation">
    <meta name="author" content="Misael Camarillo, Marvin Rayas, Cristian Tafolla">

  <title>Archenation - Carrito</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">
<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo.ico" sizes="16x16 24x24 36x36 48x48">

<body>
  <?php
    session_start();
    if($_SESSION['id'] != 1){
      header('Location: index.php');
    }
  ?>
	 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="index.php">Archenation</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="tienda.php">Productos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="logout.php">Cerrar sesión</a>
                </li>
            </ul>
          </div>
      </div>
    </nav>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <h1>Tu carrito de compras</h1>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th>Baja de Art</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Total</th>
                    <th></th>
                    <?php
                    $usuario = $_SESSION['usr'];
                    $querycliente = "SELECT IdUsuario FROM usuario WHERE usuario = '".$usuario."'";
                    $conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();
                    $result = pg_query($conn, $querycliente) or die (pg_last_error());
                    $row = pg_fetch_row($result);
                    $idUsuario = $row[0];

                    $querytotalventa = "SELECT totalVenta FROM venta WHERE idUsuario = ".$idUsuario." AND status = 'p'";
                    $result = pg_query($conn, $querytotalventa) or die (pg_last_error());
                    $row = pg_fetch_row($result);
                    $totalVenta = $row[0];
                    if($totalVenta <= 0){
                      echo'
                      <th>$ 0</th>
                      <th></th>
                      <th></th>
                      <th>$ 0</th>
                      ';
                    }else{
                      echo'
                      <th>$ '.$totalVenta.'</th>
                      <th></th>
                      <th></th>
                      <th>$ '.$totalVenta*1.16.'</th>
                      ';
                    }
                    
                    ?>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                    $usuario = $_SESSION['usr'];
                    $querycliente = "SELECT IdUsuario FROM usuario WHERE usuario = '".$usuario."'";
                    $conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();
                    $result = pg_query($conn, $querycliente) or die (pg_last_error());
                    $row = pg_fetch_row($result);
                    $idUsuario = $row[0];

                    $querytotalventa = "SELECT idVenta FROM venta WHERE idUsuario = ".$idUsuario." AND status = 'p'";
                    $result = pg_query($conn, $querytotalventa) or die (pg_last_error());
                    $row = pg_fetch_row($result);
                    $idVenta = $row[0];
                    if($idVenta > 0){
                      $querymaxArt = "SELECT COUNT(idVenta) FROM contenidoVenta WHERE idVenta = ".$idVenta;
                      $result = pg_query($conn, $querymaxArt) or die (pg_last_error());
                      $row = pg_fetch_row($result);
                      $maxArt = $row[0];

                      if($maxArt > 0){
                        $querydatosVenta = "SELECT idArticulo,cantidad,precioFinal FROM contenidoVenta WHERE idVenta = ".$idVenta;
                        $result = pg_query($conn, $querydatosVenta) or die (pg_last_error());
                        $row = pg_fetch_all($result);

                        for($cont = 0;$cont < $maxArt;$cont++){
                          $idArticuloArt = $row[$cont]['idarticulo'];
                          $cantidadArt = $row[$cont]['cantidad'];
                          $precioFinalArt = $row[$cont]['preciofinal'];

                          $querymatchart = "SELECT nombre,descripcion FROM articulo WHERE idArticulo = ".$idArticuloArt;
                          $result = pg_query($conn, $querymatchart) or die (pg_last_error());
                          $drow = pg_fetch_row($result);

                          $nombreArt = $drow[0];
                          $descripcionArt = $drow[1];

                          echo '
                            <tr>
                              <td>'.$nombreArt.'</td>
                              <td>'.$descripcionArt.'</td>
                              <td>'.$precioFinalArt.'</td>
                              <td>'.$cantidadArt.'</td>
                              <td>'.$precioFinalArt*.16.'</td>
                              <td>'.($precioFinalArt*$cantidadArt)*1.16.'</td>
                              <td><form name="modificarcarrito" action="modCarrito.php" method="post">
                                  <input type="hidden" name="idarticulo" value="'.$idArticuloArt.'">
                                  <input type="hidden" name="idventa" value="'.$idVenta.'">
                                  <input type="submit" name="submit" value="Borrar"></form></td>
                            </tr>
                          ';
                        }
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->


<footer class="py-5 bg-dark">
      <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; Archenation. 2019 <br><br> <a href="credits.php">Créditos</a> | <a href="politics.php">Políticas</a> </p>
          <br>
          
      </div>
    
    </footer>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/scrolling-nav.js"></script>

</body>

</html>
