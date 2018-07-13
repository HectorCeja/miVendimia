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
var btonInsertar = document.querySelector("#imagen-ventas");
var precarga = document.querySelector("#precarga");
var respuesta = document.querySelector("#respuesta");

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

function ejecutarAJAX(datosVenta){
	ajax = objetoAJAX();
	//Cuando un cambio de estado esté listo se ejecutará
	ajax.onreadystatechange = enviarDatos;
	//request abre el archivo controlador.php por el metodo POST
	ajax.open("POST","controlador.php");
	//mime http://eswikipedia.org/wiki/Multipurpose_Internet_Mail_Extensions#MIME-Version
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(datosVenta);
}
function altaVenta(evento){
	evento.preventDefault();
	//alert("funciona");
	//Toda operacion que interactua con la BD es transaccion
	var datosVenta = "transaccion=altaventa";
	ejecutarAJAX(datosVenta);
}
function enviarDatos(){
	precarga.style.display = "block";
	precarga.innerHTML = "<img src='imagenes/loader.gif' />";
	//codigo HTTP de estado de carga listo
	if (ajax.readyState == READY_STATE_COMPLETE) {
		//peticion 200=ok
		if(ajax.status == OK){
			//alert(ajax.responseText);
			precarga.innerHTML = null;
			precarga.style.display = "none";
			respuesta.style.display = "block";
			respuesta.innerHTML = ajax.responseText;
			//evaluar que la cadena de texto encuentre el dato mientras sea mayor a -1
			if(ajax.responseText.indexOf("data-insertar")>-1){
				
				document.querySelector("#alta-venta").addEventListener("submit",insertarVenta);
				//alert("Venta registrada con exito!");
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


function insertarVenta(evento){
	//alert("procesa formulario");
	evento.preventDefault();
	//var datos = "transaccion=insertar";
	//ejecutarAJAX(datos);
	var nombre = new Array();
	var valor = new Array();
	var hijosForm = evento.target;
	var datosVenta = "";

	for(var i = 1; i<hijosForm.length;i++){
		nombre[i] = hijosForm[i].name;
		valor[i] = hijosForm[i].value;
		datosVenta += nombre[i]+"="+valor[i]+"&";
		//console.log(datos);
	}
	ejecutarAJAX(datosVenta);

}

//Función que ejecutará AJAX



function fecha(){
	var dia = (fech.getDate()<=9)?"0"+fech.getDate():""+fech.getDate();
	var mes = (fech.getMonth()<=9)?"0"+(fech.getMonth()+1):""+(fech.getMonth()+1);
	respuestafecha.innerHTML= "Fecha: "+dia+"/"+mes+"/"+fech.getFullYear();
}
function eliminarVenta(evento){
	evento.preventDefault();
	//alert(evento.target.dataset.precio);
	//los elementosdata del backend se guardan endataset
	//alert(evento.target.dataset.id);
	var idVenta = evento.target.dataset.id;
	//var precio = evento.target.dataset.precio;
	var eliminar = confirm("¿Seguro que deseas eliminar la venta No. "+idVenta+" ?");

	if(eliminar){
		var datos = "folio_venta="+idVenta+"&transaccion=eliminarventa";
		ejecutarAJAX(datos);
	}

}

function cargaDocumento(){	
	btonInsertar.addEventListener("click",altaVenta);
	for (var i = 0;i<btnsEliminar.length; i++) {
		btnsEliminar[i].addEventListener("click",eliminarVenta);
	}
}



//asignacion de eventos
window.addEventListener("load",fecha);
window.addEventListener("load",cargaDocumento);

