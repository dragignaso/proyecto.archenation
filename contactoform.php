<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tienda virtual Archenation">
    <meta name="author" content="Misael Camarillo, Marvin Rayas, Cristian Tafolla">

  <title>Archenation - Inicia sesion</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

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
            			<a class="nav-link js-scroll-trigger" href="who.php">Quienes somos</a>
          			</li>
          			<li class="nav-item">
            			<a class="nav-link js-scroll-trigger" href="signinform.html">Registrese aqui</a>
          			</li>
          			<li class="nav-item">
            			<a class="nav-link js-scroll-trigger" href="loginform.html">Iniciar sesión</a>
          			</li>
          			<li class="nav-item active">
                		<a class="nav-link" href="contactoform.php">Contáctanos
                  			<span class="sr-only">(current)</span>
                		</a>
              		</li>
        		</ul>
      		</div>
    	</div>
  	</nav>

  	<header class="bg-primary text-white">
    	<div class="container text-center">
    		<h2>¿Tienes alguna observación?</h2>
    		<h4>Haz contacto con nosotros</h4>
    		<hr>
			<form name="contacto" action="contacto.php" method="post">
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre"><br />
				<label for="correoe">Correo electrónico: </label>
				<input type="email" name="correoe"><br />
				<label for="telefono">Teléfono: </label>
				<input type="tel" name="telefono"><br />
				<label for="mensaje">Cuentanos en el espacio de abajo: </label>
				<br>
				<input type="text" name="mensaje" size="60"><br><br>
				<input type="submit" name="submit">
			</form>
    	</div>
  	</header>

  <footer class="py-5 bg-dark">
      <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; Archenation. 2019</p>
      </div>
    
    </footer>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/scrolling-nav.js"></script>

</body>

</html>
