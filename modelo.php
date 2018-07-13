<?php 
require_once "conexion.php";

function insertarVenta($folio,$clave,$nombre,$total,$fecha){
	$mysql = conexionMySQL();
	$sql = "INSERT INTO venta(folio_venta,clave_cliente,nombre,total,fecha) VALUES ('$folio','$clave','$nombre','$total','$fecha')";
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se ingresó con exito la venta</div>";
	}else{
		$respuesta = "<div class='error' data-recarga >Ocurrió un error no se registró la venta</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function eliminarVenta($folio_venta){
	$mysql = conexionMySQL();
	$sql = "DELETE FROM venta WHERE folio_venta=$folio_venta";
	//ejecutar conexion y guardarla en una variable
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se eliminó con exito la venta</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se eliminó la venta</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function insertarCliente($clave,$nombre,$apaterno,$amaterno,$rfc){
	$mysql = conexionMySQL();

	$sql = "INSERT INTO clientes(clave_cliente,nombre,apaterno,amaterno,rfc) VALUES ('$clave','$nombre','$apaterno','$amaterno','$rfc')";
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se ingresó con exito el cliente</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se registró elcliente</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function ActualizarCliente($clave,$nombre,$apaterno,$amaterno,$rfc){
	$mysql = conexionMySQL();

	$sql = "UPDATE clientes SET clave_cliente='$clave',nombre='$nombre',apaterno='$apaterno',amaterno='$amaterno',rfc='$rfc' WHERE clave_cliente='$clave'";
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se actualizó con exito el cliente</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se actualizó el cliente</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function eliminarCliente($clave){
	$mysql = conexionMySQL();
	$sql = "DELETE FROM clientes WHERE clave_cliente=$clave";
	//ejecutar conexion y guardarla en una variable
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se eliminó con exito el cliente</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se eliminó el cliente</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function insertarArticulo($clave,$descripcion,$precio,$modelo){
	$mysql = conexionMySQL();

	$sql = "INSERT INTO articulo(clave_articulo,descripcion_articulo,precio,modelo) VALUES ('$clave','$descripcion','$precio','$modelo')";
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se ingresó con exito el articulo</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se registró el articulo</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function ActualizarArticulo($clave,$descripcion,$precio,$modelo){
	$mysql = conexionMySQL();

	$sql = "UPDATE articulo SET descripcion_articulo='$descripcion', precio='$precio',modelo='$modelo' WHERE clave_articulo='$clave'";
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se actualizó con exito el articulo</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se actualizó el articulo</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
function eliminarArticulo($clave_articulo){
	$mysql = conexionMySQL();
	$sql = "DELETE FROM articulo WHERE clave_articulo=$clave_articulo";
	//ejecutar conexion y guardarla en una variable
	if($resultado = $mysql->query($sql)){
		$respuesta = "<div class='exito' data-recarga>Se eliminó con exito el artículo</div>";
	}else{
		$respuesta = "<div class='error' data-recarga>Ocurrió un error no se eliminó el artículo</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
 ?>
