
<?php  
require_once "conexion.php";

/*
Pasos para conectarme a MySQL con PHP
1)Objeto de conexión : $MYSQL = conexionMySQL();
2)Consulta SQL: $SQL = "SELECT * FROM venta ORDER BY folio_venta DESC";
3)Ejecutar la consulta: $resultado = $mysql->query($sql)
4) Mostrar los resultados: $fila = $resultado->fetch_assoc()
*/


	
	function editarArticulo($id){
			$mysql = conexionMySQL();
			$sql = "SELECT * FROM articulo WHERE clave_articulo=$id";
			if($resultado = $mysql->query($sql)){
				$fila = $resultado->fetch_assoc();
				$form = "<form id='editar-articulo' class='formulario' data-editar>";
					$form .= "<fieldset>";
					$form .= "<legend>Edición de Artículos</legend>";
					$form .="<div id='folio'name='folios'>Folio: 000".$fila["clave_articulo"]."</div>";
					$form .= "<input type='hidden' id='clave' name='clave' name='' value='".$fila["clave_articulo"]."'/>";
					
					$form .= "<div>";
						$form .= "<label for='descripcion'>Descripción</label>";
						$form .= "<textarea type='text' id='descripcion' name='descripcion' placeholder='Descripción' required >".$fila["descripcion_articulo"]."</textarea>";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='precio'>Precio</label>";
						$form .= "<input type='text' id='precio-articulos' name='precio' placeholder='Precio' value='".$fila["precio"]."' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='modelo'>Modelo</label>";
						$form .= "<input type='text' id='modelo' name='modelo' placeholder='Modelo' value='".$fila["modelo"]."' required />";
					$form .= "</div>";					
					$form .= "<br>";
					$form .= "<br>";
					$form .= "<hr>";
					$form .= "<input type='submit' id='actualizar-btn' name='insertar_btn' value='actualizar'/>";
					$form .= "<input type='hidden' id='transaccion' name='transaccion' value='actualizararticulo'/>";
					$form .= "<input type='hidden' id='clave_articulo' name='clave_articulo' value='".$fila["clave_articulo"]."'/>";
				$form .= "</fieldset>";
				$form .= "</form>";
				$resultado->free();
			}else{
				$form = "<div class='error'>Error: No se ejecutó la consulta a la Base de Datos</div>";
			}
			$mysql->close();
			return printf($form);
	}
	function editarCliente($id){
			$mysql = conexionMySQL();
			$sql = "SELECT * FROM clientes WHERE clave_cliente=$id";

			if($resultado = $mysql->query($sql)){
				$fila = $resultado->fetch_assoc();

				$form = "<form id='editar-cliente' class='formulario' data-editar>";
					$form .= "<fieldset>";
						$form .= "<legend>Edición de Clientes</legend>";
						$form .="<div id='folio'name='folios'>Folio: 000".$fila["clave_cliente"]."</div>";
						$form .= "<input type='hidden' id='clave' name='clave' value='".$fila["clave_cliente"]."'/>";
						$form .= "<div>";
							$form .= "<label for='nombre'>Nombre</label>";
							$form .= "<input type='text' id='nombre' name='nombre' placeholder='Nombre(s)' value='".$fila["nombre"]."' required />";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<div>";
							$form .= "<label for='apaterno'>Apellido Paterno</label>";
							$form .= "<input type='text' id='apaterno' name='apaterno' placeholder='Apellido Paterno' value='".$fila["apaterno"]."' required />";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<div>";
							$form .= "<label for='amaterno'>Apellido Materno</label>";
							$form .= "<input type='text' id='amaterno' name='amaterno' placeholder='Apellido Materno' value='".$fila["amaterno"]."' required />";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<div>";
							$form .= "<label for='rfc'>RFC</label>";
							$form .= "<input type='text' id='rfc' name='rfc' placeholder='RFC' value='".$fila["rfc"]."' required />";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<hr>";
						$form .= "<input type='submit' id='insertar-btn' name='insertar_btn' value='Actualizar'/>";
						$form .= "<input type='hidden' id='transaccion' name='transaccion' value='actualizarcliente'/>";
						$form .= "<input type='hidden' id='clave_cliente' name='clave-cliente' value='".$fila["clave_cliente"]."'/>";
					$form .= "</fieldset>";
				$form .= "</form>";
				$resultado->free();
			}else{
				$form = "<div class='error'>Error: No se ejecutó la consulta a la Base de Datos</div>";
			}
			$mysql->close();
			return printf($form);
	}

	function altaVenta(){
		$mysql = conexionMySQL();
		$sql = "SELECT * FROM venta";
		$sql2 = "SELECT * FROM articulo";
		$resultadoArticulo = $mysql->query($sql2);
		$folioventa = $mysql->query($sql);
		$resultfolio = $folioventa->fetch_assoc();
		$tamaño = 0;
		if($folioventa = $mysql->query($sql)){
			while($fila = $folioventa->fetch_assoc()){
				$tamaño++;
			}
		}

		$folioAMostrar = ($resultfolio["folio_venta"]+$tamaño);

		$claveAMostrar = ($resultfolio["clave_cliente"]+$tamaño);

		$form = "<form id='alta-venta' class='formulario' data-insertar>";
			$form .= "<fieldset>";
				$form .= "<legend>Registro de Ventas</legend>";
				$form .="<div id='folio'name='folios'>Folio: 000".$folioAMostrar."</div>";
				$form .= "<input type='hidden' id='folio' name='folio' value='".$folioAMostrar."'/>";
				$form .= "<input type='hidden' id='clave' name='clave' value='".$claveAMostrar."'/>";
				$form .= "<div>";
					$form .= "<label for='cliente'>Cliente</label>";
					$form .= listaClientes();
					
				$form .= "</div>";
				$form .= "<hr>";
				$precio = "";
				
				$form .= "<input type='hidden' id='fecha' name='fecha' value='2016-08-17'/>";
				$form .= "<div>";
					$form .= "<label for='articulo'>Artículo</label>";
					if($fila = $resultadoArticulo->fetch_assoc()){
						
						$form .= "<select id='articuloz' name='articulo_txt'  required>";
						$precioU= $fila["precio"];
						$form .= "<option value='".$fila["descripcion_articulo"]."' >".$fila["descripcion_articulo"]."</option>";
						while ($fila = $resultadoArticulo->fetch_assoc()) {
							
							$form .= "<option value='".$fila["descripcion_articulo"]."'>".$fila["descripcion_articulo"]."</option>";
							
					}
						$form .= "</select>";
						
						$form .= "</div>";
						$form .= "<div>";
						$form .= "<br>";
						$enganche = .20;
						$tasa = 2.8;
						$plazo = 12;

						$precio = $precioU * (1+($tasa*$plazo)/100);
						$importe = $precio*1;
						$form .= "<div>";
						$form .= "<label for='articulo'>Precio</label>";
						$form .= "<input type='text' id='preci' name='total' value='".$precio."'/>";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<div>";
						$form .= "<label for='articulo'>Importe</label>";
						$form .= "<input type='text' id='preci' name='total' value='".$importe."'/>";
						$form .= "</div>";
						$form .= "<br>";

						
						$enganchetotal = $enganche*$importe;
						$form .= "<div>";
						$form .= "<label for='articulo'>Enganche</label>";
						$form .= "<input type='text' id='preci' name='total' value='".$enganchetotal."'/>";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<div>";
						$bonificacion = $enganchetotal * (($tasa*$plazo)/100);
						$form .= "<label for='articulo'>Bonificación Enganche</label>";
						$form .= "<input type='text' id='preci' name='total' value='".$bonificacion."'/>";
						$form .= "</div>";
						$form .= "<br>";
						$form .= "<label for='articulo'>Plazo</label>";
						$form .= "<input type='text' id='plazo' name='total' value='".$plazo." meses'/>";
						$form .= "</div>";
						$form .= "<br>";

						$total = $importe - $enganchetotal - $bonificacion;
						$form .= "<div>";
						$form .= "<label for='articulo'>Total</label>";
						$form .= "<input type='text' id='precio' name='total' value='".$total."'/>";
						$form .= "<input type='hidden' id='total' name='total' value='".$total."'/>";
						$form .= "</div>";
				}
				$form .= "<hr>";
				$form .= "<input type='submit' id='insertar-btn' name='insertar_btn' value='Guardar'/>";
				$form .= "<input type='hidden' id='transaccion' name='transaccion' value='insertarventa'/>";
			$form .= "</fieldset>";
		$form .= "</form>";
		return printf($form);
	}

	function altaCliente(){
			$mysql = conexionMySQL();
			$sql = "SELECT * FROM clientes";

			$foliocliente = $mysql->query($sql);
			$resultfolioCliente = $foliocliente->fetch_assoc();
			$tamañoCliente = 0;
			if($foliocliente = $mysql->query($sql)){
				while($fila = $foliocliente->fetch_assoc()){
					$tamañoCliente++;
				}
			}

			$claveAMostrar = ($resultfolioCliente["clave_cliente"]+$tamañoCliente);

			$form = "<form id='alta-cliente' class='formulario' data-insertar>";
				$form .= "<fieldset>";
					$form .= "<legend>Registro de Clientes</legend>";
					$form .="<div id='folio'name='folios'>Folio: 000".$claveAMostrar."</div>";
					$form .= "<input type='hidden' id='clave' name='clave' value='".$claveAMostrar."'/>";
					$form .= "<div>";
						$form .= "<label for='nombre'>Nombre</label>";
						$form .= "<input type='text' id='nombre' name='nombre' placeholder='Nombre(s)' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='apaterno'>Apellido Paterno</label>";
						$form .= "<input type='text' id='apaterno' name='apaterno' placeholder='Apellido Paterno' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='amaterno'>Apellido Materno</label>";
						$form .= "<input type='text' id='amaterno' name='amaterno' placeholder='Apellido Materno' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='rfc'>RFC</label>";
						$form .= "<input type='text' id='rfc' name='rfc' placeholder='RFC' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<hr>";
					$form .= "<input type='submit' id='insertar-btn' name='insertar_btn' value='Guardar'/>";
					$form .= "<input type='hidden' id='transaccion' name='transaccion' value='insertarcliente'/>";
				$form .= "</fieldset>";
			$form .= "</form>";
			return printf($form);
	}
	function altaArticulo(){
			$mysql = conexionMySQL();
			$sql = "SELECT * FROM articulo";

			$folioarticulo = $mysql->query($sql);
			$resultfolioCliente = $folioarticulo->fetch_assoc();
			$tamañoArticulo = 0;
			if($folioarticulo = $mysql->query($sql)){
				while($fila = $folioarticulo->fetch_assoc()){
					$tamañoArticulo++;
				}
			}

			$claveAMostrar = ($resultfolioCliente["clave_articulo"]+$tamañoArticulo);

			$form = "<form id='alta-articulo' class='formulario' data-insertar>";
				$form .= "<fieldset>";
					$form .= "<legend>Registro de Artículos</legend>";
					$form .="<div id='folio'name='folios'>Folio: 000".$claveAMostrar."</div>";
					$form .= "<input type='hidden' id='clave' name='clave' value='".$claveAMostrar."'/>";
					
					$form .= "<div>";
						$form .= "<label for='descripcion'>Descripción</label>";
						$form .= "<input type='text' id='descripcion' name='descripcion' placeholder='Descripción' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='precio-'>Precio</label>";
						$form .= "<input type='text' id='precio-articulos' name='precio' placeholder='Precio' required />";
					$form .= "</div>";
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='modelo'>Modelo</label>";
						$form .= "<input type='text' id='modelo' name='modelo' placeholder='Modelo' required />";
					$form .= "</div>";					
					$form .= "<br>";
					$form .= "<div>";
						$form .= "<label for='existencia'>Existencia</label>";
						$form .= "<input type='text' id='existencia' name='existencia' placeholder='Existencia' required />";
					$form .= "</div>";

					$form .= "<br>";
					$form .= "<hr>";
					$form .= "<input type='submit' id='insertar-btn' name='insertar_btn' value='Guardar'/>";
					$form .= "<input type='hidden' id='transaccion' name='transaccion' value='insertararticulo'/>";
				$form .= "</fieldset>";
				$form .= "<script src='js/funcionesArticulo'></script>";
			$form .= "</form>";
			return printf($form);
	}

	
	function listaClientes(){
		$mysql = conexionMySQL();
		$sql = "SELECT * FROM clientes";
		$resultado = $mysql->query($sql);

		$lista = "<select id='cliente' name='cliente_txt' required>";
		$lista .= "<option value=''>- - - - -</option>";
		while ($fila = $resultado->fetch_assoc()) {
			$lista .= "<option value='".($fila["nombre"]." ".$fila["apaterno"]." ".$fila["amaterno"])."'>".($fila["nombre"]." ".$fila["apaterno"]." ".$fila["amaterno"])."</option>"; 
		}
		$lista .= "</select>";
		$resultado->free();
		$mysql->close();
		return $lista;

	}
	function listaArticulos(){
		$mysql = conexionMySQL();
		$sql = "SELECT * FROM articulo";
		$resultado = $mysql->query($sql);

		$lista = "<select id='articulo' name='articulo_txt' required>";
		$lista .= "<option value=''>- - - - -</option>";
		while ($fila = $resultado->fetch_assoc()) {
			$lista .= "<option value='".$fila["descripcion_articulo"]."'>".$fila["descripcion_articulo"]."</option>"; 
		}
		$lista .= "</select>";
		$resultado->free();
		$mysql->close();
		return $lista;

	}

	function mostrarVentas(){
		
		$mysql = conexionMySQL();
		$sql = "SELECT * FROM venta ORDER BY folio_venta DESC";

		if ($resultado = $mysql->query($sql)) {
			//echo "wiiii";
					
				
					$tabla = "<table id='tabla-ventas' class='tabla'>";
						$tabla .= "<caption>Ventas Activas</caption>";
						$tabla .= "<thead>";
							$tabla .= "<tr>";
								$tabla .= "<th><strong>Folio Venta</strong></th>";
								$tabla .= "<th><strong>Clave Cliente</strong></th>";
								$tabla .= "<th><strong>Nombre</strong></th>";
								$tabla .= "<th><strong>Total</strong></th>";
								$tabla .= "<th><strong>Fecha</strong></th>";
								$tabla .= "<th></th>";
							$tabla .= "</tr>";
						$tabla .= "</thead>";
						$tabla .= "<tbody>";
							while($fila = $resultado->fetch_assoc()){
								$tabla .="<tr>";
									$tabla .="<td>000".$fila["folio_venta"]."</td>";
									$tabla .="<td>000".$fila["clave_cliente"]."</td>";
									$tabla .="<td>".$fila["nombre"]."</td>";
									$tabla .="<td>".$fila["total"]."</td>";
									$tabla .="<td>".$fila["fecha"]."</td>";
									
									$tabla .="<td><a href='#' class='eliminar' data-id='".$fila["folio_venta"]."'><img src='imagenes/eliminar.PNG' class='eliminars' data-id='".$fila["folio_venta"]."'/></a></td>";

								$tabla .="</tr>";
							}
							$resultado->free();
						$tabla .= "</tbody>";
					$tabla .= "</table>";
					$tabla .= "<div id='werty'>";
				$tabla .= "</div>";
			printf($tabla);
		}else{
			//echo "noooo";
			$mysql->close();
			$respuesta = "<div class='error'>Error: No se ejecutó la consulta a la Base de Datos</div>";
			printf($respuesta);
		}
	}



	function mostrarClientes(){
		$mysql = conexionMySQL();
		$sql = "SELECT * FROM clientes ORDER BY clave_cliente DESC";

		if ($resultado = $mysql->query($sql)) {
					$tabla = "<table id='tabla-clientes' class='tabla'>";
						$tabla .= "<caption>Clientes Registrados</caption>";
						$tabla .= "<thead>";
							$tabla .= "<tr>";
								$tabla .= "<th><strong>Clave Cliente</strong></th>";
								$tabla .= "<th><strong>Nombre</strong></th>";
								$tabla .= "<th></th>";
							$tabla .= "</tr>";
						$tabla .= "</thead>";
						$tabla .= "<tbody>";
							while($fila = $resultado->fetch_assoc()){
								$tabla .="<tr>";
									$tabla .="<td>000".$fila["clave_cliente"]."</td>";
									$tabla .="<td>".$fila["nombre"]." ".$fila["apaterno"]." ".$fila["amaterno"]."</td>";
									$tabla .="<td><a href='#' class='editar' data-id='".$fila["clave_cliente"]."'>
													<img src='imagenes/editar.PNG' class='editars' data-id='".$fila["clave_cliente"]."'/>
									</a></td>";
									$tabla .="<td>
									<a href='#' class='eliminar' data-id='".$fila["clave_cliente"]."'>
													<img src='imagenes/eliminar.PNG' class='eliminars' data-id='".$fila["clave_cliente"]."'/>
									</a>
											</td>";
								$tabla .="</tr>";
							}
							$resultado->free();
						$tabla .= "</tbody>";
					$tabla .= "</table>";
			printf($tabla);
		}else{
			
			$mysql->close();
			$respuesta = "<div class='error'>Error: No se ejecutó la consulta a la Base de Datos</div>";
			printf($respuesta);
		}
	}

	function mostrarArticulos(){
		$mysql = conexionMySQL();
		$sql = "SELECT * FROM articulo ORDER BY clave_articulo DESC";

		if ($resultado = $mysql->query($sql)) {
			

					$tabla = "<table id='tabla-articulos' class='tabla'>";
						$tabla .= "<caption>Artículos Registrados</caption>";
						$tabla .= "<thead>";
							$tabla .= "<tr>";
								$tabla .= "<th><strong>Clave Artículo</strong></th>";
								$tabla .= "<th><strong>Descripción</strong></th>";
								$tabla .= "<th></th>";
							$tabla .= "</tr>";
						$tabla .= "</thead>";
						$tabla .= "<tbody>";
							while($fila = $resultado->fetch_assoc()){
								$tabla .="<tr>";
									$tabla .="<td>000".$fila["clave_articulo"]."</td>";
									$tabla .="<td>".$fila["descripcion_articulo"]."</td>";
									$tabla .="<td><a href='#' class='editar' data-id='".$fila["clave_articulo"]."'><img src='imagenes/editar.PNG' class='editars' data-id='".$fila["clave_articulo"]."'/></a></td>";
									$tabla .="<td><a href='#' class='eliminar' data-id='".$fila["clave_articulo"]."'><img src='imagenes/eliminar.PNG' class='eliminars' data-id='".$fila["clave_articulo"]."'/></a></td>";
								$tabla .="</tr>";
							}
							$resultado->free();
						$tabla .= "</tbody>";
					$tabla .= "</table>";
			printf($tabla);
		}else{
			
			$mysql->close();
			$respuesta = "<div class='error'>Error: No se ejecutó la consulta a la Base de Datos</div>";
			printf($respuesta);
		}
	}
	$tasaU = 0;
	$engancheU = 0;
	$plazoU = 0;
	function configuracion(){
		$forma = "<form id='configuracion-form' data-insertar>";
				$forma .= "<div>";
					$forma .= "<label for='tasa'>Tasa de financiamiento:</label>";
					$forma .= "<input type='text' id='tasa' required>";
				$forma .= "</div>";
				$forma .= "<br>";
				$forma .= "<div>";
					$forma .= "<label for='enganche'> Enganche</label>";
					$forma .= "<input type='text' id='enganche' required>";
				$forma .= "</div>";
				$forma .= "<br>";
				$forma .= "<div>";
					$forma .= "<label for='plazo'>Plazo Máximo</label>";
					$forma .= "<input type='text' id='plazo' required>";
				$forma .= "</div>";
				$forma .= "<br>";
				$forma .= "<input type='submit' id='btn-config' name='btn-config' value='Guardar'/>";
				$forma .= "<input type='hidden' id='transaccion' name='transaccion' value='insertarconfiguracion'/>";
				$forma .= "<br>";
			$forma .= "</form>";

			printf($forma);
	}
	
	function actualizarConfiguracion($tasa,$enganche,$plazo){
		$tasaU=$tasa;
		$engancheU=$enganche;
		$plazoU=$plazo;
	}
?>

