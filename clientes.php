<?php  require "vistas.php"; ?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Clientes</title>
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
			<div id="respuesta-cliente"></div>
			<div id="precarga-cliente"></div>
			<div id="imagen">
				<a href="#"><img  id="imagen-cliente" src="imagenes/newcliente.PNG"></a>
			</div>
			
			<br>
			<br>

			<?php mostrarClientes() ?>
		</div>
	</section>
	<script src="js/funcionesCliente.js"></script>
</body>
</html>
