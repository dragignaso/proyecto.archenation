<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="Tienda virtual Archenation">
  	<meta name="author" content="Misael Camarillo, Marvin Rayas, Cristian Tafolla">

	<title>Archenation - Tienda</title>

	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  	<link href="css/style.css" rel="stylesheet">
	
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo.ico" sizes="16x16 24x24 36x36 48x48">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    	<div class="container">
      		<a class="navbar-brand js-scroll-trigger" href="index.php">Archenation</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      		</button>
      		<div class="collapse navbar-collapse" id="navbarResponsive">
        		<?php
            session_start();
            if($_SESSION['id'] == 1){
              echo '
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="carrito.php">Tu carrito</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="logout.php">Cerrar sesión</a>
                    </li>
                </ul>
              ';
            }
            ?>
      		</div>
    	</div>
  	</nav>

  	  <div class="container">

    <div class="row">
      <div class="col-lg-3"><h2>_</h2>

        <h1 class="my-4">Archenation Shop</h1>
        <div class="list-group">
          <!--<a href="#" class="list-group-item">Arcos de fantasía</a>
          <a href="#" class="list-group-item">Arcos recurvos</a>-->
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9"><h2>_</h2>

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
          <?php
          $queryindex = "SELECT MAX(idArticulo) FROM articulo";
          $querycontenido = "SELECT nombre,descripcion,imagen,precio,cantidad,enDescuento,porcentajeDescuento,activo FROM articulo";
          $conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

          $result = pg_query($conn, $queryindex) or die (pg_last_error());
          $row = pg_fetch_row($result);

          $maxArt = $row[0];

          $result = pg_query($conn, $querycontenido) or die (pg_last_error());
          $row = pg_fetch_all($result);
          pg_close();

          echo ''.$row[0]['endescuento'];

          for($cont = 0;$cont < $maxArt;$cont++){
            $nombreArt = $row[$cont]['nombre'];
            $descripcionArt = $row[$cont]['descripcion'];
            $imagenArt = $row[$cont]['imagen'];
            $precioArt = $row[$cont]['precio'];
            $cantidadArt = $row[$cont]['cantidad'];
            $enDescuentoArt = $row[$cont]['endescuento'];
            $porcentajeDescuentoArt = $row[$cont]['porcentajedescuento'];
            $activoArt = $row[$cont]['activo'];

            if($activoArt == 't'){
              echo '
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <a href="articulo.php?art='.$nombreArt.'"><img class="card-img-top" src="/img/articulos/'.$imagenArt.'" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="articulo.php?art='.$nombreArt.'">'.$nombreArt.'</a>
                    </h4>
                    <h5>$'.$precioArt.'</h5>
                    <p class="card-text">'.$descripcionArt.'</p>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                  </div>
                </div>
              </div>
              ';
            }
          }
          ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>

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
