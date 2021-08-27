// // ****************************para buscar el chat del cliente seleccionado****************************
// function helloLuis(idCliente){
// 	// datos = new FormData()
// 	// datos.append('idCliente', idCliente)
// 	// urlDestino = `../ajax/ajaxChatsCliente.php`

// 	// fetch(urlDestino, {
// 	// 	method : 'post',
// 	// 	body : datos
// 	// })
// 	// .then((respuesta) => respuesta.json())
// 	// .then((respuesta) => {
// 	// 	mostrarDatosss(respuesta);
// 	// });
// 	console.log('dddas')
// }

// ****************************mostrar el div del mensaje****************************
// function d(mensaje){
	
// 	// para extraer el idCliente y idUsuario
// 	let id = mensaje[mensaje.length-1]

// 	// para extraer solo mensajes de ambos
// 	let mensajes = mensaje.splice(0, mensaje.length-1)		

// 	let li = ''
// 	mensajes.forEach( function(mensaje, index) {
		
// 		if (mensaje.envio == 1) {
// 			li +=` <li class="chat-item odd list-style-none mt-3 " >
//                     <div class="chat-content text-right d-inline-block pl-3">
//                         <div class="box msg p-2 d-inline-block mb-1 box">
//                         	${mensaje.chct_mensaje}
//                         </div>
//                         <br>
//                     </div>
//                     <div class="chat-time text-right d-block font-10 mt-1 mr-0 mb-3"> </div>
//                 </li>`
// 		}else if (mensaje.envio == 0) {
// 			li+=`<li class="chat-item list-style-none mt-3">
// 	                <div class="chat-img d-inline-block"><img
// 	                    src="rrr" alt="user"
// 	                    class="rounded-circle" width="45">
// 	                </div>
// 	                <div class="chat-content d-inline-block pl-3">
// 	                    <h6 class="font-weight-medium"></h6>
// 	                    <div class="msg p-2 d-inline-block mb-1">
// 	                    	${mensaje.chct_mensaje}
// 	                   	</div>
// 	                </div>
// 	                <div class="chat-time d-block font-10 mt-1 mr-0 mb-3"></div>
// 	            </li>`
// 		}
// 	});
// 	document.getElementById('mensajeLista').innerHTML = li
// 	let barraM = document.getElementById('barraM')
// 	barraM.style.display = 'block'
// 	document.getElementById('idRec').value = id.idCliente

// }

// // ********************************para responder al cliente********************************
// function enviarMensajeUsuario(){
// 	mensaje = document.querySelector('#mensajeEnv').value
// 	idCliente = document.querySelector('#idRec').value
// 	if(mensaje){
// 		datos = new FormData()
// 		datos.append('mensaje', mensaje)
// 		datos.append('idCliente', idCliente)
// 		urlDestino = `../ajax/ajaxChatsCliente.php`

// 		fetch(urlDestino, {
// 			method : 'post',
// 			body : datos
// 		})
// 		.then((respuesta) => respuesta.json())
// 		.then((respuesta) => {
// 			mostrarDatos(respuesta);
// 		});
// 	}
// }

