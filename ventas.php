<?php  require "vistas.php"; ?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Vendimia</title>
	<meta name="description" content="Aplicación web para la venta de articulos vendimia">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div id="contenedor">
		<div class="dropdown">
  			<button class="dropbtn">Inicio</button>
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
		<div id="blanco">
			
		</div>
		<div id="contenido">
			<div id="respuesta"></div>
			<div id="precarga"></div>
			<a href="#"><img  id="imagen-ventas" src="imagenes/newventa.PNG"></a>
			<br>
			<br>
			
			<?php mostrarVentas()?>
		</div>
	</section>
	<script src="js/funciones.js"></script>
</body>
</html>
