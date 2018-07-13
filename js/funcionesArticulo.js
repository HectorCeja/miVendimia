var READY_STATE_COMPLETE = 4;
var OK = 200; 

//variables
var fech = new Date();
var respuestafecha = document.getElementById("fecha-respuesta");
//Es null para dar soporte a los distintos navegadores
var ajax = null;









var btnsEliminar = document.querySelectorAll(".eliminar");
var btnsEditar = document.querySelectorAll(".editar");
var btnInsertar = document.querySelector("#imagen-articulos");
var precargaArticulo = document.querySelector("#precarga-articulo");
var respuestaArticulo = document.querySelector("#respuesta-articulo");
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


function enviarDatosArticulo(){
	precargaArticulo.style.display = "block";
	precargaArticulo.innerHTML = "<img src='imagenes/loader.gif' />";
	//codigo HTTP de estado de carga listo
	if (ajax.readyState == READY_STATE_COMPLETE) {
		//peticion 200=ok
		if(ajax.status == OK){
			//alert(ajax.responseText);
			precargaArticulo.innerHTML = null;
			precargaArticulo.style.display = "none";
			respuestaArticulo.style.display = "block";
			respuestaArticulo.innerHTML = ajax.responseText;
			//evaluar que la cadena de texto encuentre el dato mientras sea mayor a -1
			if(ajax.responseText.indexOf("data-insertar")>-1){
				
				document.querySelector("#alta-articulo").addEventListener("submit",insertarEditarArticulo);
				//alert("Articulo guardado con exito!");
			}
			if(ajax.responseText.indexOf("data-editar")>-1){
				
				document.querySelector("#editar-articulo").addEventListener("submit",insertarEditarArticulo);
				//alert("Articulo guardado con exito!");
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
function ejecutarAJAXArticulo(datosArticulo){
	ajax = objetoAJAX();
	//Cuando un cambio de estado esté listo se ejecutará
	ajax.onreadystatechange = enviarDatosArticulo;
	//request abre el archivo controlador.php por el metodo POST
	ajax.open("POST","controlador.php");
	//mime http://eswikipedia.org/wiki/Multipurpose_Internet_Mail_Extensions#MIME-Version
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(datosArticulo);
}

function insertarEditarArticulo(evento){
	//alert("procesa formulario");
	evento.preventDefault();
	//var datos = "transaccion=insertar";
	//ejecutarAJAX(datos);
	var nombre = new Array();
	var valor = new Array();
	var hijosForm = evento.target;
	var datosArticulo = "";

	for(var i = 1; i<hijosForm.length;i++){
		nombre[i] = hijosForm[i].name;
		valor[i] = hijosForm[i].value;
		datosArticulo += nombre[i]+"="+valor[i]+"&";
		//console.log(datos);
	}
	ejecutarAJAXArticulo(datosArticulo);

}

//Función que ejecutará AJAX

function altaArticulo(evento){
	evento.preventDefault();
	//alert("funciona");
	//Toda operacion que interactua con la BD es transaccion
	var datosArticulo = "transaccion=altaarticulo";
	ejecutarAJAXArticulo(datosArticulo);
}

function fecha(){
	var dia = (
		fech.getDate()<=9)?"0"+fech.getDate():""+fech.getDate();
	var mes = (fech.getMonth()<=9)?"0"+(fech.getMonth()+1):""+(fech.getMonth()+1);
	respuestafecha.innerHTML= "Fecha: "+dia+"/"+mes+"/"+fech.getFullYear();
}

function eliminarArticulo(evento){
	evento.preventDefault();
	//los elementosdata del backend se guardan endataset

	var idArticulo = evento.target.dataset.id;
	var eliminar = confirm("¿Seguro que deseas eliminar el artículo No. "+idArticulo+" ?");

	if(eliminar){
		var datos = "clave_articulo="+idArticulo+"&transaccion=eliminararticulo";
		ejecutarAJAXArticulo(datos);
	}

}
function editarArticulo(evento){
	evento.preventDefault();
	//alert(evento.target.dataset.id);
    var idArticulo = evento.target.dataset.id;
    var datos = "clave_articulo="+idArticulo+"&transaccion=editararticulo";
    //solicitud al backend
    ejecutarAJAXArticulo(datos);
}

function cargaDocumento(){	
	btnInsertar.addEventListener("click",altaArticulo);

	for (var i = 0;i<btnsEliminar.length; i++) {
		btnsEliminar[i].addEventListener("click",eliminarArticulo);
	}
	for (var i = 0;i<btnsEditar.length; i++) {
		btnsEditar[i].addEventListener("click",editarArticulo);
	}

	
	 
}



//asignacion de eventos

window.addEventListener("load",fecha);
window.addEventListener("load",cargaDocumento);

