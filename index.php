<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="Tienda virtual Archenation">
  	<meta name="author" content="Misael Camarillo, Marvin Rayas, Cristian Tafolla">

	<title>Archenation</title>

	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  	<link href="css/style.css" rel="stylesheet">
</head>
<body id = "page-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    	<div class="container">
      		<a class="navbar-brand js-scroll-trigger" href="index.php">Archenation</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      		</button>
      		<div class="collapse navbar-collapse" id="navbarResponsive">
        		<ul class="navbar-nav ml-auto">
        			<li class="nav-item">
            			<a class="nav-link js-scroll-trigger" href="who.php">Quienes somos</a>
          			</li>
          			<li class="nav-item">
            			<a class="nav-link js-scroll-trigger" href="signinform.html">Registrese aqui</a>
          			</li>
          			<li class="nav-item">
            			<a class="nav-link js-scroll-trigger" href="loginform.html">Iniciar sesión</a>
          			</li>
          			<li class="nav-item">
            			<a class="nav-link js-scroll-trigger" href="contactoform.php">Contáctanos</a>
          			</li>
        		</ul>
      		</div>
    	</div>
  	</nav>

  	<header class="bg-primary text-white">
    	<div class="container text-center">
      		<h1>Bienvenido a Archenation</h1>
      		<p class="lead">Imagina. Nosotros hacemos el resto.</p>
    	</div>
  	</header>

  	<div class="container">
    	<div class="row align-items-center my-5">
      		<div class="col-lg-7">
        		<img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt="">
      		</div>
      
      		<div class="col-lg-5">
        		<h1 class="font-weight-light">Arcos recurvos</h1>
        		<p>Arcos resistentes y cómodos para maniobrar con ellos.</p>
      		</div>
    	</div>
    </div>

  	<div class="container">
    	<div class="row align-items-center my-5">
			<div class="col-lg-5">
        		<h1 class="font-weight-light">Arcos de fantasía</h1>
        		<p>¿Quieres ser como tu arquero favorito? <br> Nosotros podemos darte su arco.</p>
      		</div>
      		<div class="col-lg-7">
        		<img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt="">
      		</div>
      

    	</div>
    </div>
	
	<?php

		session_start();
		if($_SESSION['id'] == 1){
			$usuario = $_SESSION['usr'];
			$queryUsuario = "SELECT nombre,apaterno,amaterno FROM usuario WHERE usuario = '".$usuario."'";
			$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationclient password=archeclient") or die();

			$result = pg_query($conn, $queryUsuario) or die (pg_last_error());

			$row = pg_fetch_row($result);

			$nombreUsr = $row[0];
			$aPaternoUsr = $row[1];
			$aMaternoUsr = $row[2];
			echo "Bienvenido ".$nombreUsr." ".$aPaternoUsr." ".$aMaternoUsr;
		}else{
			if($_SESSION['id'] == 99){
			$usuario = $_SESSION['usr'];
			$queryUsuario = "SELECT nombre,apaterno,amaterno FROM usuario WHERE usuario = '".$usuario."'";
			$conn = pg_connect("host=127.0.0.1 port=5432 dbname=archenationbd user=archenationclient password=archeclient") or die();

			$result = pg_query($conn, $queryUsuario) or die (pg_last_error());

			$row = pg_fetch_row($result);

			$nombreUsr = $row[0];
			$aPaternoUsr = $row[1];
			$aMaternoUsr = $row[2];
			echo "Bienvenido ".$nombreUsr." ".$aPaternoUsr." ".$aMaternoUsr;
			echo "Modo Admin";

			echo '
				<a href="gestionusuarios.php">Gestion de usuarios</a>
				<a href="gestionarticulos.php">Gestion de artículos</a>
';
			echo '<a href="logout.php">Cerrar sesión</a>';
			}
		}
	?>

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
