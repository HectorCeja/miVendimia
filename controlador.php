<?php 
	require "vistas.php";
	require "modelo.php";
/*
Aplicacion CreateReadUpdateDelete
PHP TIENE 2 METODOS DE ENVIO DE DATOS: GET Y POST

C  AFECTA BD     INSERT(SQL) POST  Modelo
R  NO AFECTA BD  SELECT(SQL) GET   Vista
U  AFECTA BD     UPDATE(SQL) POST  Modelo
D  AFECTA BD     DELETE(SQL) POST  Modelo
*/
	//METODOS DE ENVIO DE FORMULARIOS GET Y POST
	$transaccion = $_POST["transaccion"];
	//echo $transaccion;
	function ejecutarTransaccion($transaccion){
		if($transaccion=="altaventa"){
			//mostrar formulario alta
			altaVenta();
			
		}else if($transaccion=="altacliente"){
			//mostrar formulario alta
			altaCliente();

		}else if($transaccion=="altaarticulo"){
			//mostrar formulario alta
			altaArticulo();

		}else if($transaccion=="insertarventa"){
			//procesar los datos del formulario de alta e insertarlos en mysql
			//echo "gogog";
			insertarVenta($_POST["folio"],$_POST["clave"],$_POST["cliente_txt"],$_POST["total"],$_POST["fecha"]);

		}else if($transaccion=="insertarcliente"){
			//procesar los datos del formulario de alta e insertarlos en mysql
			//echo "gogog";
			insertarCliente($_POST["clave"],$_POST["nombre"],$_POST["apaterno"],$_POST["amaterno"],$_POST["rfc"]);

		}else if($transaccion=="insertararticulo"){
			//procesar los datos del formulario de alta e insertarlos en mysql
			//echo "gogog";
			insertarArticulo($_POST["clave"],$_POST["descripcion"],$_POST["precio"],$_POST["modelo"]);

		}else if($transaccion=="eliminarventa"){
			//eliminar de mysql el registro solicitado
			eliminarVenta($_POST["folio_venta"]);

		}else if($transaccion=="eliminarcliente"){
			//eliminar de mysql el registro solicitado
			eliminarCliente($_POST["clave_cliente"]);

		}else if($transaccion=="eliminararticulo"){
			//eliminar de mysql el registro solicitado
			eliminarArticulo($_POST["clave_articulo"]);
			
		}else if ($transaccion=="editararticulo") {
			//traer los datos del registro a modificar en un formulario
			editarArticulo($_POST["clave_articulo"]);

		}else if ($transaccion=="editarcliente") {
			//traer los datos del registro a modificar en un formulario
			editarCliente($_POST["clave_cliente"]);

		}else if ($transaccion=="actualizarcliente") {
			//modificar en mysql los datos del registro modificado
			ActualizarCliente($_POST["clave"],$_POST["nombre"],$_POST["apaterno"],$_POST["amaterno"],$_POST["rfc"]);
		
		}else if ($transaccion=="actualizararticulo") {
			//modificar en mysql los datos del registro modificado
			ActualizarArticulo($_POST["clave"],$_POST["descripcion"],$_POST["precio"],$_POST["modelo"]);
		}else if($transaccion=="insertarconfiguracion"){
			actualizarConfiguracion($_POST["tasa"],$_POST["enganche"],$_POST["plazo"]);
		}

	}
	ejecutarTransaccion($transaccion);

 ?>