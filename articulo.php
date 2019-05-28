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
        		<ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="tienda.php">Productos</a>
                </li>
                <?php
                session_start();
                if($_SESSION['id'] == 1){
                  echo '
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="carrito.php">Tu carrito</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="logout.php">Cerrar sesión</a>
                    </li>
                  ';
                }
                ?>
        		</ul>
      		</div>
    	</div>
  	</nav>

  	  <div class="container">

    <div class="row">

      <div class="col-lg-3"><h2>_</h2>
        <h1 class="my-4">Archenation Shop</h1>
        <div class="list-group">
          <!--<a href="#" class="list-group-item active">Arcos recurvos</a>
          <a href="#" class="list-group-item">Arcos de fantasía</a>-->
        </div>
      </div>

      <div class="col-lg-9"><h2>_</h2>
        <?php
          session_start();
          $nombreTemp = $_GET['art'];
          $querycontenido = "SELECT idArticulo,nombre,descripcion,imagen,precio,cantidad,enDescuento,porcentajeDescuento FROM articulo WHERE nombre = '".$nombreTemp."'";
          $conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationuser password=archeuser1234") or die();

          $result = pg_query($conn, $querycontenido) or die (pg_last_error());
          $row = pg_fetch_row($result);

          $idArticulo = $row[0];
          $nombreArt = $row[1];
          $descripcionArt = $row[2];
          $imagenArt = $row[3];
          $precioArt = $row[4];
          $cantidadArt = $row[5];
          $enDescuentoArt = $row[6];
          $porcentajeDescuentoArt = $row[7];

          echo '
          <div class="card mt-4">
            <img class="card-img-top img-fluid" src="/img/articulos/'.$imagenArt.'" alt="">
            <div class="card-body">
              <h3 class="card-title">'.$nombreArt.'</h3>
              <h4>$'.$precioArt.'</h4>
              <p class="card-text">'.$descripcionArt.'</p>';
          if($cantidadArt > 0 && $_SESSION['id'] == 1){
            echo'
                <form name="compraarticulo" action="compra.php" method="post">
                  <label for="cantidad">Cantidad: </label>
                  <input type="number" name="cantidad" min="1" max="'.$cantidadArt.'" value="1"><br />
                  <input type="hidden" name="idarticulo" value="'.$idArticulo.'"><br />
                  <input type="submit" name="submit" value="Agregar al Carrito">
                </form>
            ';
          }else{
            if($cantidadArt <= 0 && $_SESSION['id'] == 1){
              echo '<p>Producto Agotado</p>';
            }else{
              echo '<p>Necesitas estar logueado para comprar</p>
                  <a href="loginform.html">Clic aqui para iniciar sesión</a><br />
                  <a href="signinform.html">Clic aqui si aún no tienes cuenta</a><br />
              ';
            }
          }
          echo '
              <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
              4.0 stars
            </div>
          </div>
          ';
        ?>
        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Product Reviews
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <a href="#" class="btn btn-success">Leave a Review</a>
          </div>
        </div>

      </div>

    </div>

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
