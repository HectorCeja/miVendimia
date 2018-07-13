var form = document.getElementById("configuracion-form");
var r = document.getElementById("valores");
var plazo = document.getElementById("plazo"); 

var fech = new Date();
var respuestafecha = document.getElementById("fecha-respuesta");

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

function enviarDatos(){
	
	//codigo HTTP de estado de carga listo
	if (ajax.readyState == READY_STATE_COMPLETE) {
		//peticion 200=ok
		if(ajax.status == OK){
			//alert(ajax.responseText);
			//evaluar que la cadena de texto encuentre el dato mientras sea mayor a -1
			if(ajax.responseText.indexOf("data-insertar")>-1){
				
				document.querySelector("#configuracion-form").addEventListener("submit",insertarConf);
				//alert("Venta registrada con exito!");
			}
		}else{
			alert("El servidor no contestó\nError: "+ajax.status+": "+ajax.statusText);
		}
	}
}

function insertarConf(evento){
	//alert("procesa formulario");
	evento.preventDefault();
	//var datos = "transaccion=insertar";
	//ejecutarAJAX(datos);
	var nombre = new Array();
	var valor = new Array();
	var hijosForm = evento.target;
	var datos = "";

	for(var i = 1; i<hijosForm.length;i++){
		nombre[i] = hijosForm[i].name;
		valor[i] = hijosForm[i].value;
		datos += nombre[i]+"="+valor[i]+"&";
		console.log(datos);
	}
	ejecutarAJAX(datos);

}

function altaConf(evento){
	evento.preventDefault();
	//alert("funciona");
	//Toda operacion que interactua con la BD es transaccion
	var datosVenta = "transaccion=insertarconfiguracion";
	ejecutarAJAX(datos);
}





function eshio(){
	r.innerHTML = "Plazo: "+plazo.value;
}

function fecha(){
	var dia = (fech.getDate()<=9)?"0"+fech.getDate():""+fech.getDate();
	var mes = (fech.getMonth()<=9)?"0"+(fech.getMonth()+1):""+(fech.getMonth()+1);
	respuestafecha.innerHTML= "Fecha: "+dia+"/"+mes+"/"+fech.getFullYear();
}

form.addEventListener("submit",eshio);
window.addEventListener("load",fecha);

