<?php 
	//php..net/manual/es/
	//include_once("config.php");
	require_once "config.php";
	function conexionMySQL(){
		//echo "Hola por favor no usen echos";
		$conexion = new mysqli(SERVER,USER,PASS,BD);
		if ($conexion->connect_error) {
			$error = "<div class='error'>Error de conexión N° <b>%d</b> Mensaje del error: <mark>%s</mark></div>";
			printf($error,$conexion->connect_errno,$conexion->connect_error);
		}
		$conexion->query("SET CHARACTER SER UTF8");
		return $conexion;
	}
	//conexionMySQL();
?>