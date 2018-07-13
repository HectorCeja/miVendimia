//constante
//4 = peticion completa

var READY_STATE_COMPLETE = 4;
var OK = 200; 

//variables
var fech = new Date();
var respuestafecha = document.getElementById("fecha-respuesta");
//Es null para dar soporte a los distintos navegadores
var ajax = null;
var btnsEliminar = document.querySelectorAll(".eliminar");
var btnsEditar = document.querySelectorAll(".editar");
var btnInsertar = document.querySelector("#imagen-cliente");
var precargaCliente = document.querySelector("#precarga-cliente");
var respuestaCliente = document.querySelector("#respuesta-cliente");
//funciones

function objetoAJAX(){
	
	if(window.XMLHttpRequest){
		//soporte para chrome
		return new XMLHttpRequest();
	}else if(window.activeXObject){
		//soporte para internet explorer
		return new activeXObject("Microsoft.XMLHTTP");
	}
}


function enviarDatosCliente(){
	precargaCliente.style.display = "block";
	precargaCliente.innerHTML = "<img src='imagenes/loader.gif' />";
	//codigo HTTP de estado de carga listo
	if (ajax.readyState == READY_STATE_COMPLETE) {
		//peticion 200=ok
		if(ajax.status == OK){
			//alert(ajax.responseText);
			precargaCliente.innerHTML = null;
			precargaCliente.style.display = "none";
			respuestaCliente.style.display = "block";
			respuestaCliente.innerHTML = ajax.responseText;
			//evaluar que la cadena de texto encuentre el dato mientras sea mayor a -1
			if(ajax.responseText.indexOf("data-insertar")>-1){
				
				document.querySelector("#alta-cliente").addEventListener("submit",insertarEditarCliente);
				//alert("Cliente guardado con exito!");
			}
			if(ajax.responseText.indexOf("data-editar")>-1){
				
				document.querySelector("#editar-cliente").addEventListener("submit",insertarEditarCliente);
				//alert("Cliente guardado con exito!");
			}
			if(ajax.responseText.indexOf("data-recarga")>-1){
				setTimeout(window.location.reload(),6000);
			}
		}else{
			alert("El servidor no contestó\nError: "+ajax.status+": "+ajax.statusText);
		}
	}
}
//Funcionará para las 4 operaciones CRUD
function ejecutarAJAXCliente(datosCliente){
	ajax = objetoAJAX();
	//Cuando un cambio de estado esté listo se ejecutará
	ajax.onreadystatechange = enviarDatosCliente;
	//request abre el archivo controlador.php por el metodo POST
	ajax.open("POST","controlador.php");
	//mime http://eswikipedia.org/wiki/Multipurpose_Internet_Mail_Extensions#MIME-Version
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(datosCliente);
}

function insertarEditarCliente(evento){
	//alert("procesa formulario");
	evento.preventDefault();
	//var datos = "transaccion=insertar";
	//ejecutarAJAX(datos);
	var nombre = new Array();
	var valor = new Array();
	var hijosForm = evento.target;
	var datosCliente = "";

	for(var i = 1; i<hijosForm.length;i++){
		nombre[i] = hijosForm[i].name;
		valor[i] = hijosForm[i].value;
		datosCliente += nombre[i]+"="+valor[i]+"&";
		//console.log(datos);
	}
	ejecutarAJAXCliente(datosCliente);

}

//Función que ejecutará AJAX

function altaCliente(evento){
	evento.preventDefault();
	//alert("funciona");
	//Toda operacion que interactua con la BD es transaccion
	var datosCliente = "transaccion=altacliente";
	ejecutarAJAXCliente(datosCliente);
}

function fecha(){
	var dia = (fech.getDate()<=9)?"0"+fech.getDate():""+fech.getDate();
	var mes = (fech.getMonth()<=9)?"0"+(fech.getMonth()+1):""+(fech.getMonth()+1);
	respuestafecha.innerHTML= "Fecha: "+dia+"/"+mes+"/"+fech.getFullYear();
}

function eliminarCliente(evento){
	evento.preventDefault();
	//los elementosdata del backend se guardan endataset
	//alert(evento.target.dataset.id);
	var idCliente = evento.target.dataset.id;
	var eliminar = confirm("¿Seguro que deseas eliminar al cliente No. "+idCliente+" ?");

	if(eliminar){
		var datos = "clave_cliente="+idCliente+"&transaccion=eliminarcliente";
		ejecutarAJAXCliente(datos);
	}

}
function editarCliente(evento){
	evento.preventDefault();
	//alert(evento.target.dataset.id);
    var idCliente = evento.target.dataset.id;
    var datos = "clave_cliente="+idCliente+"&transaccion=editarcliente";
    //solicitud al backend
    ejecutarAJAXCliente(datos);
}

function cargaDocumento(){	
	btnInsertar.addEventListener("click",altaCliente);

	for (var i = 0;i<btnsEliminar.length; i++) {
		btnsEliminar[i].addEventListener("click",eliminarCliente);
	}
	for (var i = 0;i<btnsEditar.length; i++) {
		btnsEditar[i].addEventListener("click",editarCliente);
	}
	 
}



//asignacion de eventos
window.addEventListener("load",fecha);
window.addEventListener("load",cargaDocumento);

