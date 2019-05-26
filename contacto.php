<?php
	$nombre = $_POST['nombre'];
	$correoe = $_POST['correoe'];
	$telefono = $_POST['telefono'];
	$mensaje = $_POST['mensaje'];
	

	$destino = "archenation@gmail.com";
	$desde = "FROM:". "Archenation - System";
	$asunto = "Contacto - ArchenationWeb";
	$mensaje = "Contacto de: ".$nombre."\nCorreo: ".$correoe."\nTeléfono: ".$telefono."\n\nAsunto: ".$mensaje;
	mail($destino,$asunto,$mensaje,$desde);
	echo "Correo enviado";

	$variable = md5('4rch3n4t10n');

	echo ''.$variable;
?>