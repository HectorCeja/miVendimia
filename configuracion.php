<?php  require "vistas.php"; ?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Configuración</title>
	<meta name="description" content="Aplicación web para la venta de articulos vendimia">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div id="contenedor">
		<div class="dropdown">
  			<button class="dropbtn">Inicio</button>
  			<div></div>
  			<div class="dropdown-contenido">
    			<a href="ventas.php">Ventas</a>
    			<a href="clientes.php">Clientes</a>
    			<a href="articulos.php">Articulos</a>
    			<a href="configuracion.php">Configuración</a>
  			</div>
		</div>
		<div id="fecha-respuesta"></div>
	</div>
	<section id="contenedor-principal">
		<div id="blanco"></div>
		<div id="contenido">
			<div id="titulo-contenido">Configuración General</div>
			<br>
			<br>
			
			<?php configuracion() ?>
		</div>
		<br>
		<br>
		<div id="valores"></div>
		<script src="js/funcionesConf.js"></script>
	</section>
</body>
</html>