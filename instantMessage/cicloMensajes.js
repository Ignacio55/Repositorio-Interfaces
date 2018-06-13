function objetoXHR(){
	if (window.XMLHttpRequest)
	{
		// El navegador implementa la interfaz XHR de forma nativa
		return new XMLHttpRequest();
	} 
	else if (window.ActiveXObject)
	{
		var versionesIE = new Array('Msxml2.XMLHTTP.5.0', 'Msxml2.XMLHTTP.4.0',
		'Msxml2.XMLHTTP.3.0', 'Msxml2.XMLHTTP', 'Microsoft.XMLHTTP'); 
		 
		for (var i = 0; i < versionesIE.length; i++) 
		{ 
			try  
			{ /* Se intenta crear el objeto en Internet Explorer comenzando
			en la versión más moderna del objeto hasta la primera versión. 
			En el momento que se consiga crear el objeto, saldrá del bucle
			devolviendo el nuevo objeto creado. */
			return new ActiveXObject(versionesIE[i]); 
			}  
			catch (errorControlado) {}//Capturamos el error,
		} 
	} 
	/* Si llegamos aquí es porque el navegador no posee ninguna forma de crear el objeto.
	Emitimos un mensaje de error usando el objeto Error. 
	
	*/ 
	throw new Error("No se pudo crear el objeto XMLHttpRequest"); 
}
/*
 * function enviarmensaje(event){
	event.preventDefault();
	sala = obtenersala(location.href);
	mensaje = document.getElementById('idMensajeTexto').value;
	var xhttp = new XMLHttpRequest();
	xhttp.open('POST', "salaChat.php", true);
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var node = document.createElement("div");                 // Create a <div> node
			var textnode = document.createTextNode(xhttp.responseText+": "+mensaje);         // Create a text node
			node.appendChild(textnode);                              // Append the text to <li>
			document.getElementById("chat").appendChild(node);  
			document.getElementById('idMensajeTexto').value = '';
		}
	};
	parametros = "sala="+sala+"&mensaje="+mensaje;
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send(parametros);
}
 * */
function abrirChat(event) {
	xhrMensaje=new objetoXHR();
	event.preventDefault();
	sala = obtenersala(location.href);
	
	/*d = new Date();
	
	minutos=addZero(d.getMinutes());
	horas=addZero(d.getHours());
	segundos=addZero(d.getSeconds());
	
	tiempo= d.getFullYear()+ '-' + (d.getMonth()+1) +'-'+ d.getDate() +' '+ horas +':'+ minutos +':'+segundos;
	console.log("---"+tiempo);*/
	var xhttp = new XMLHttpRequest();
	
	xhttp.open('POST', "salaChat.php", true);
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			dibujarMensaje(xhttp);
		}
	}
	
	parametros = "estado=abrir&sala="+sala;
	
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send(parametros);
	console.log("++");
	//comprobamos que lo ha creado
	/*if (xhrMensaje){
		xhrMensaje.open('POST','salaChat.php', true );
		
		xhrMensaje.onreadystatechange=function(){
			if (xhrMensaje.readyState==4){ 
				if (xhrMensaje.status==200 || xhrMensaje.status==304){
					//dibujarMensaje(xhrMensaje);
				}else{
					alert("Ha habido un error");
				}
			}
		}
		xhrMensaje.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhrMensaje.send("tiempo =");	
		
	}*/
}
var myvar=setInterval(actualizarChat,1000);

function actualizarChat(){
	xhrMensaje=new objetoXHR();
	//event.preventDefault();
	sala = obtenersala(location.href);
	
	var xhttp = new XMLHttpRequest();
	
	xhttp.open('POST', "salaChat.php", true);
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
		}
	}
	
	parametros = "estado=actualizar&sala="+sala;
	
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send(parametros);
	console.log("--");
	/*xhrMensaje=new objetoXHR();
	//comprobamos que lo ha creado
	if (xhrMensaje){
		xhrMensaje.open('POST','salaChat.php', true );
		if ((xhrMensaje.status==200) || (xhrMensaje.status==304)){
			
			dibujarMensaje(xhrMensaje);
		}		
		
	}
	//YYYY-MM-DD HH:MM:SS
	d = new Date();
    $hasta= d.getFullYear()+ '-' + (d.getMonth()+1) +'-'+ d.getDate() +' '+ d.getHours() +':'+ d.getMinutes() +':'+d.getSeconds();
    

    xhrMensaje.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	tiempo=$hasta;
		xhrMensaje.send("tiempo ="+tiempo);*/
}

function dibujarMensaje(xhr1){
	//alert(eval(xhr1.responseText));
	var mensajes=eval('('+xhr1.responseText+')');
	
	if(mensajes.length != -1){
		
		for(var i=0; i < mensajes.length ; i++){
			if(mensajes[i].usuario == "<?php echo $_SESSION['user']; ?>"){
				mensaje="<p class='ajeno' "+mensajes[i].texto+"</p>";
				document.getElementById("chat").insertAdjacentHTML("beforeend",mensaje);
			}else{
				mensaje="<p class='propio' "+mensajes[i].texto+"</p>";
				document.getElementById("chat").insertAdjacentHTML("beforeend",mensaje);
			}
		}
		
	}else{
		alert("Error al recibir los datos");
	}
}


function enviarmensaje(event){
	event.preventDefault();
	sala = obtenersala(location.href);
	mensaje = document.getElementById('idMensajeTexto').value;
	var xhttp = new XMLHttpRequest();
	xhttp.open('POST', "salaChat.php", true);
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			/*var node = document.createElement("div"); // Create a <div> node
			var textnode = document.createTextNode(xhttp.responseText+": "+mensaje);         // Create a text node
			node.appendChild(textnode);                              // Append the text to <li>
			document.getElementById("chat").appendChild(node);  
			document.getElementById('idMensajeTexto').value = '';*/
			document.getElementById("idMensajeTexto").value="";  
		}
	};
	parametros = "sala="+sala+"&mensaje="+mensaje;
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send(parametros);
}


function obtenersala(sala){
    separador = "?", // un espacio en blanco
    limite = 2
    partes = sala.split(separador, limite);
    separador = "=", // un espacio en blanco
    limite = 2
    partes = partes[1].split(separador, limite);
    return partes[1];
}

function obtenernombre(sala){
	//probar con substring
    separador = "?nom", // un espacio en blanco
    limite = 2
    partes = sala.split(separador, limite);
    separador = "=", // un espacio en blanco
    limite = 2
    partes = partes[1].split(separador, limite);
    
    document.getElementById("titulo").innerHTML=String(partes[1]);
}

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
