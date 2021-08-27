
const formularios_ajax = document.querySelectorAll('.FormularioAjax');

function enviarFormularioAjax(e){
	e.preventDefault();

	let data = new FormData(this);
	let method = this.getAttribute("method");
	let action = this.getAttribute("action");
	let tipo = this.getAttribute("data-form");

	let encabezados = new Headers();

	let config = {
		method : method,
		headers : encabezados,
		mode : 'cors',
		cache : 'no-cache',
		body : data
	};


	// 
	if (tipo =='mensaje') {

		// validar que no este vacio el mensaje
		let mensaje = document.getElementById('mensajeEnv').value
		if (mensaje != '') {

			fetch(action,config)
			.then((respuesta) => respuesta.json())
			.then((datos) => {
				mostrarDatos(datos,tipo ='mensajes')
				document.getElementById('mensajeEnv').value = ''
			});
		}else{
			console.log('vacio')
		}
	}else{
 


	let texto_alerta;

	if(tipo === 'save'){
		texto_alerta = "Los datos quedaran guardados en el sistema";
	}
	else if(tipo === 'delete'){
		texto_alerta = "Los datos seran eliminados completamente del sistema";
	}
	else if(tipo === 'update'){
		texto_alerta = "Los datos del sistema seran actualizados";
	}
	else if(tipo === 'search'){
		texto_alerta = "Se eliminara el termino de busqueda y tendras que escribir uno nuevo";
	}
	else if(tipo === 'loands'){
		texto_alerta = "Desea remover los datos seleccionados para prestamos o reservaciones";
	}
	else{
		texto_alerta = "Quieres realizar la operacion dsolicitada";
	}

	Swal.fire({
			title: '¿ Estás seguro ?',
			text: texto_alerta,
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if(result.value){
				fetch(action,config)
				.then((respuesta) => respuesta.json())
				.then((respuesta) => {
					return alertas_ajax(respuesta);
				});
			}
		});
	}

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviarFormularioAjax);


});



function alertas_ajax(alerta){
	if(alerta.Alerta==="simple"){
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			type: alerta.Tipo,
			confirmButtonText: 'Aceptar'
		});
	}else if(alerta.Alerta === "recargar"){
		Swal.fire({
			title 				: alerta.Titulo,
			text  				: alerta.Texto,
			type  				: alerta.Tipo,
			confirmButtonText	:'Aceptar'
		}).then((result) => {
			if(result.value){
				location.reload();
			}
		});
	}
	else if(alerta.Alerta === "limpiar"){
		Swal.fire({
			title:alerta.Titulo,
			text:alerta.Texto,
			type : alerta.Tipo,
			confirmButtonText:'Aceptar'
		}).then((result) => {
			if(result.value){
				document.querySelector('.FormularioAjax').reset();
			}
		});
	}else if(alerta.Alerta === "redireccionar"){
		window.location.href = alerta.URL;
	}
}



// traerDatos()
// Traer datos por ID
function traerDatos(id,tipoprod =0){
	let datos = new FormData()
	urlE =location.href
	porciones = urlE.split('/');
	urlD = `../ajax/productsAjax.php`
	if(id == 10001){
		datos.append('idLista',id)
	}else if (tipoprod == 2) {
		// para edicion rapida
		datos.append('prod_rapido',id)
	}

	else if (tipoprod == 3) {
		// para edicion rapida
		datos.append('prod_detalles',id)
	}

	else if (tipoprod == 4) {
		// para edicion rapida
		datos.append('prod_fotos',id)
	}

	else{
		datos.append('idDato',id)
	}
	let ddd = [];
	fetch(urlD,{
		method : 'POST',
		body : datos
	})
	.then((respuesta) => respuesta.json())
	.then(datos => {
		ddd = datos;
		if(id ==10001){
			mostrarDatos(datos,lista='listaP')
		}
		
		else{
			mostrarDatos(ddd)
		}
	})

} 

function mostrarFotos(datos){
	let div =typeof da
	// datos.forEach( function(element, index) {
	// 
	// });
	document.querySelector('#datosProd_fotos').innerHTML = div
}


// Mostrar Datos
function mostrarDatos(datos,tipo=0){

	// Modal Categoria
	if (datos.tipo == 'category') {
		let estado = datos.cat_estado == 1 ? 'checked' : ''
		let title = datos.cat_estado == 1 ? 'Activo' : 'Desactivo'
		let div =`
			<div class="card-body">
				<h4 class="card-title">Nombre Categoria</h4> 
					<input type="hidden"  name="id_cat" value ="${datos.id_cat}">
					<div class="form-group">
						<input type="text" class="form-control" name="categoria_name_edit" id="categoria_name_edit" placeholder="Nombre Categoria" value ="${datos.cat_nombre}">
					</div>
					<h4 class="card-title">Estado Categoria</h4>
                    <div class="input-group mb-3">  
                        <div class="custom-control custom-switch">
                            <input type="checkbox" ${estado}  class="custom-control-input" id="rrd" name="rre">
                            <label class="custom-control-label" for="rrd"> ${title}</label>
                        </div>
                    </div>
				</div>
			</div>`
		document.querySelector('#datosCat').innerHTML = div
	}

	// Modal Productos 
	else if (datos.tipo == 'products') {
		let estado = datos.prod_estado == 1 ? 'checked' : ''
		let title = datos.prod_estado == 1 ? 'Activo' : 'Desactivo'
		let div =`
			<input type="hidden"  name="id_prod" value ="${datos.id_prod}">

			<div class="row">
                <div class="col-md-5">
                    <h4 class="card-title">Nombre Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_name_edit" 
                        id="categoria_name_edit" placeholder="Nombre Producto" value = "${datos.prod_nombre}" >
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="card-title">Estado Producto</h4>
                    <div class="input-group mb-3">  
			            <div class="custom-control custom-switch">
			                <input type="checkbox"  ${estado}   class="custom-control-input" id="producto_status_edit" name="producto_status_edt">
			                <label class="custom-control-label" for="producto_status_edit">  ${title}</label>
			            </div>
			        </div>
                </div>
                
                <div class="col-md-4">
                    <h4 class="card-title">Stock Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_stock_edit" 
                        id="" placeholder="Stock Producto" value = "${datos.prod_stock}" >
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="card-title">Marca Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_marca_edit" 
                        id="" placeholder="Stock Producto" value = "${datos.marca}" >
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="card-title">Modelo Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_modelo_edit" 
                        id="" placeholder="Stock Producto" value = "${datos.modelo}" >
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="card-title">Tags Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_tags_edit" 
                        id="" placeholder="Stock Producto" value = "${datos.tags}" >
                    </div>
                </div>
				<div class="col-md-4">
                    <h4 class="card-title">Precio Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_price_edit" 
                        id="" placeholder="Precio Producto"  value = "${datos.prod_precio}" >

                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="card-title">Desc Producto</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="producto_desc_edit" 
                        id="" placeholder="Stock Producto" value = "${datos.descuent}" >
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="card-title">Fecha Desc</h4>
                    <div class="form-group">
                        <input type="date" class="form-control" name="producto_fecdesc_edit" 
                        id="" placeholder="Stock Producto" value = "${datos.fecha_des}" >
                    </div>
                </div>

				<div class="col-md-12">
					<h4 class="card-title">Especificaciones del producto </h4>
					<div class="form-floating">
						<textarea class="form-control" rows="15" placeholder="Separado por una barra '/' " name="especif_edit" style="height: 100px" >${datos.prod_espec}</textarea>
						</div>
				</div>
            </div>`
		document.querySelector('#datosProd').innerHTML = div
	}
	else if (datos.tipo == 'detalles') {
		// let estado = datos.prod_estado == 1 ? 'checked' : ''
		// let title = datos.prod_estado == 1 ? 'Activo' : 'Desactivo'
		// <input type="hidden"  name="id_prod" value ="${datos.id_prod}">
		let div =`
			<input type="hidden"  name="id_prodd" value ="${datos.id_det_prod}">
				<div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Tallas Disponibles</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="producto_tal_edit" 
                            id="categoria_name_edit" placeholder="Digite las tallas separadas por una coma (s,m,l)"  value = "${datos.det_prod_tallas}" >

                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <h4 class="card-title">Colores Disponibles</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="producto_col_edit" 
                            id="categoria_name_edit" placeholder="Digite los colores separadas por una coma (28,30,32)" value = "${datos.det_prod_color}" >

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">Peso-Volumen</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="producto_pes_vol_edit" 
                            id="categoria_name_edit" placeholder="---" value = "${datos.det_prod_peso}" >

                        </div>
                    </div>
                
                    <div class="col-md-3">
                        <h4 class="card-title">Altura</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="producto_alt_edit" 
                            id="categoria_name_edit" placeholder="---" value = "${datos.det_prod_altura}" >

                        </div>
                    </div>

                    <div class="col-md-3">
                        <h4 class="card-title">Ancho</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="producto_anch_edit" 
                            id="categoria_name_edit" placeholder="---" value = "${datos.det_prod_ancho}" >

                        </div>
                    </div>
                
                    <div class="col-md-3">
                        <h4 class="card-title">Largo</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" name="producto_larg_edit" 
                            id="categoria_name_edit" placeholder="---" value = "${datos.det_prod_largo}" >
                        </div>
                    </div>

                </div>`
		document.querySelector('#datosProd_det').innerHTML = div
	}
// http://127.0.0.1/pepstore/view/images/categorias/zapatillas.png
	else if (datos.tipo == 'fotos') {

		let fotop = datos.foto_url ? '': ' Cargar una foto del producto'
		let foto1 = datos.foto_p ? '': ' Cargar una foto del producto'
		let foto2 = datos.foto_s ? '': ' Cargar una foto del producto'
		let foto3 = datos.foto_t ? '': ' Cargar una foto del producto'
		div =''
			div +=`<div class="row">
				<input type="hidden"  name="id_prod_fotos" value ="${datos.fotp_id_prod}">
				<input type="hidden"  name="id_fots" value ="${datos.id_fotp}">
                    <div class="col-12">
                        <!-- Row -->
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-6 col-md-6">
                                <!-- Card -->
                                    <img class="card-img-top img-fluid" src="..${datos.foto_url}"
                                        alt="Card image cap" >
                                    <div class="card-body">
                                     	<h4 class="card-title">Foto <i>Portada </i>producto</h4>
                                        <fieldset class="form-group">
	                                        <input type="file" class="form-control-file" name="fot_port">
	                                    </fieldset>
                                    </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-lg-6 col-md-6">
                                <!-- Card -->
                                    <img class="card-img-top img-fluid" src="..${datos.foto_p}"
                                         alt="${foto1}" >
                                    <div class="card-body">
                                     	<h4 class="card-title">Fotos <i>detalldes</i> producto</h4>
                                        <fieldset class="form-group">
	                                        <input type="file" class="form-control-file" name="fot_u">
	                                    </fieldset>
                                    </div>
                                <!-- Card -->
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <!-- Card -->
                                    <img class="card-img-top img-fluid" src="..${datos.foto_s}"
                                         alt="${foto2}" >
                                    <div class="card-body">
                                     	<h4 class="card-title">Fotos <i>detalles</i> producto</h4>
                                        <fieldset class="form-group">
	                                        <input type="file" class="form-control-file" name="fot_d">
	                                    </fieldset>
                                    </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-lg-6 col-md-6">
                                <!-- Card -->
                                    <img class="card-img-top img-fluid" src="..${datos.foto_t}"	
                                        alt="${foto3}" >
                                    <div class="card-body">
                                     	<h4 class="card-title">Fotos <i>detalles</i> producto</h4>
                                        <fieldset class="form-group">
	                                        <input type="file" class="form-control-file" name="fot_t">
	                                    </fieldset>
                                    </div>
                                <!-- Card -->
                            </div>
                            
                        </div>
                        <!-- Row -->
                    </div>
                </div>`




		// let div =`
		
		// 	
 
			
		// 		
		document.querySelector('#datosProd_fotos').innerHTML = div
	}

	else if(datos.tipo == 'usuario'){
		let roladmin = datos.rol_id_rol == 1 ? 'selected' :  ''
		let rolcajero = datos.rol_id_rol == 2? 'selected' :  ''
		let rolvendedor = datos.rol_id_rol == 3? 'selected' :  ''

		let estado = datos.u_status == 1 ? 'checked' : ''
		let title = datos.u_status == 1 ? 'Activo' : 'Desactivo'
		
		// let estado = datos.u_status == 1 ? 'selected' : ''

		let div = `
		<input type="hidden"  name="id_user" value ="${datos.id_u}">
			<div class="row">

		      	<div class="col-md-6">
		    		<h4 class="card-title">Nombre</h4>
		      		<div class="form-group">
						<input type="text" class="form-control" name="user_name_edit" 
						id="categoria_name_edit" placeholder="Nombre Categoria" value ="${datos.u_name}">

					</div>
				</div>

				<div class="col-md-6">
		    		<h4 class="card-title">Apellidos</h4>
		      		<div class="form-group">
						<input type="text" class="form-control" name="user_last_edit" 
						id="categoria_name_edit" placeholder="Nombre Categoria" value ="${datos.u_last}">

					</div>
				</div>

				<div class="col-md-6">
		    		<h4 class="card-title">Privilegio Usuario</h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Privilegios</label>
                                    </div>
                                    <select class="custom-select" name="user_privelgio_edit">
                                        <option ${roladmin}  value="1">Administrator</option>
                                        <option ${rolcajero} value="2">Cajero</option>
                                        <option ${rolvendedor} value="3">Vendedor</option>
                                    </select>
                                </div>
				</div>

		     	
		    	<div class="col-md-6">
                    <h4 class="card-title">Estado Usuario</h4>
                    <div class="input-group mb-3">  
			            <div class="custom-control custom-switch">
			                <input type="checkbox"  ${estado}   class="custom-control-input" id="user_estado" name="user_status_edt">
			                <label class="custom-control-label" for="user_estado">  ${title}</label>
			            </div>
			        </div>
                </div>
				<div class="col-md-6">
		    		<h4 class="card-title">Usuario</h4>
		      		<div class="form-group">
						<input type="text" class="form-control" name="user_user_edit" 
						id="categoria_name_edit" placeholder="Nombre Categoria" value ="${datos.u_user}">

					</div>
				</div>

				<div class="col-md-6">
		    		<h4 class="card-title">Contraseña</h4>
		      		<div class="form-group">
						<input type="password" class="form-control" name="user_pass_edit" 
						id="categoria_name_edit" placeholder="Nombre Categoria" value ="${datos.u_pass}">

					</div>
				</div> 
		    </div>`

		if (datos.privilegio == 2 || datos.privilegio == 3) {
			

		div +=    `<div class="row">
		      	<div class="col-md-6">
		    		<h4 class="card-title">Usuario</h4>
		    		<h6 class="card-subtitle">Para validar los cambios</h6>	
		      		<div class="form-group">
						<input type="text" class="form-control" name="user_user" 
						id="user_user" placeholder="Usuario" >

					</div>
				</div>

				<div class="col-md-6">
		    		<h4 class="card-title">Password</h4>
		    		<h6 class="card-subtitle">Para validar los cambios</h6>	
		      		<div class="form-group">
						<input type="text" class="form-control" name="user_pass" 
						id="user_pass" placeholder="Password" >

					</div>
				</div>
		    </div>

		    `
		}
		document.querySelector('#datosUser').innerHTML = div
	}	

	// ********************Modal Listar Productos********************
	// mostrar las categorias disponibles para el usuario
	if (tipo == 'listaP') {
		let option = ''
		datos.forEach( function(element, index) {
			option += `<option  value="${element.id_cat}">${element.cat_nombre}</option>`
			
		});
		document.getElementById('categorias').innerHTML = option
	}
	// ******************************Mostrar Mensaje de un User***************************
	if (tipo == 'mensajes') {
		console.log(datos)
		// para extraer el idCliente y idUsuario
		let id = datos[datos.length-1]
		
		// para extraer solo mensajes de ambos
		let mensajes = datos.splice(0, datos.length-1)		
		
		let li = ''
		console.log(mensajes)
		mensajes.forEach( function(mensaje, index) {
			
			
			if (mensaje.chct_envio == 1) {
				li +=` <li class="chat-item odd list-style-none mt-3 " >
	                    <div class="chat-content text-right d-inline-block pl-3">
	                        <div class="box msg p-2 d-inline-block mb-1 box">
	                        	${mensaje.chct_mensaje}
	                        </div>
	                        <br>
	                    </div>
	                    <div class="chat-time text-right d-block font-10 mt-1 mr-0 mb-3"> </div>
	                </li>`
			}else if (mensaje.chct_envio == 0) {
				li+=`<li class="chat-item list-style-none mt-3">
		                <div class="chat-img d-inline-block"><img
		                    src="rrr" alt="user"
		                    class="rounded-circle" width="45">
		                </div>
		                <div class="chat-content d-inline-block pl-3">
		                    <h6 class="font-weight-medium"></h6>
		                    <div class="msg p-2 d-inline-block mb-1">
		                    	${mensaje.chct_mensaje}
		                   	</div>
		                </div>
		                <div class="chat-time d-block font-10 mt-1 mr-0 mb-3"></div>
		            </li>`
			}
		});
		document.getElementById('mensajeLista').innerHTML = li
		let barraM = document.getElementById('barraM')
		barraM.style.display = 'block'
		document.getElementById('idClientessss').value = id.idCliente

	}
	
} 



// traer Mensaje del IDUser
function listarMensaje(idU){

	let datos = new FormData()
	datos.append('idListaM',idU)
	urlE =location.href
	porciones = urlE.split('/');
	urlD = `../ajax/${porciones[5]}Ajax.php`
	fetch(urlD,{
		method : 'POST',
		body : datos
	})
	.then((respuesta) => respuesta.json())
	.then(data =>mostrarDatos(data,tipo ='mensajes'))
} 

// const listaCursos = document.querySelector('#mensajesssd')
// listaCursos.addEventListener('click', (e)=>{
// 	e.preventDefault();
// 	if( e.target.classList.contains('message-titled') ) {

// 		// quitar la clase
// 		let desp = document.querySelectorAll('.message-title')
// 		desp.forEach( function(element, index) {
// 			element.classList.remove('activeee');
// 		});
// 		// pintar el chat add la clase
// 		let user = e.target
// 		user.classList.add('activeee')
		
//     	let idUser = e.target.parentElement.parentElement.firstElementChild.value

//     	listarMensaje(idUser)
//     	// console.log(idUser)
//     }
// });   

function eliminar(id,tipo){
	let table
	switch(tipo) {
		case 0:
			table ='category'
			break;
		case 1:			
			table ='products'
			break;
	}

	let datos = new FormData()
	datos.append('id_del',id)
	
	urlD = `../ajax/${table}Ajax.php`
	
	Swal.fire({
			title: '¿ Estás seguro ?',
			text: 'Los datos seran eliminados completamente del sistema',
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		})
	.then((result) => {
			if(result.value){
				fetch(urlD,{
					method : 'POST',
					body : datos
				})
				.then((respuesta) => respuesta.json())
				.then((respuesta) => {
					return alertas_ajax(respuesta);
				});
			}
		});
} 




function cambioEstadoComment(estado, id){
	let status = (estado == true) ? 1 : 0 
	// console.log(status)
	// console.log(id)
  	let datos = new FormData()
	datos.append('status',status)	
	datos.append('id',id)	
	urlD = `../ajax/commentsAjax.php`

	fetch(urlD,{
		method : 'POST',
		body : datos
	})
	.then((respuesta) => respuesta.json())
	.then((respuesta) => {
		return alertas_ajax(respuesta);
	});
}









function myFunction(idCliente){
	// datos = new FormData()
	// datos.append('idCliente', idCliente)
	// urlDestino = `../ajax/ajaxChatsCliente.php`

	// fetch(urlDestino, {
	// 	method : 'post',
	// 	body : datos
	// })
	// .then((respuesta) => respuesta.json())
	// .then((respuesta) => {
	// 	mostrarDatosss(respuesta);
	// });
	console.log(idCliente)
}

// onclick
function traerChatCliente(idCliente){
	datos = new FormData()
	datos.append('idCliente', idCliente)
	urlDestino = `../ajax/ajaxChatsCliente.php`

	fetch(urlDestino, {
		method : 'post',
		body : datos
	})
	.then((respuesta) => respuesta.json())
	.then((respuesta) => {
		mostrarDatos(respuesta,tipo ='mensajes')
		traerListaClienteChat()
	});
}


// para enviar y traer todos los mensajes
function enviarMensajeUsuario(){
	mensaje = $('#retuas').val();
	idCliente = $('#idClientessss').val();

	if (mensaje) {
		document.querySelector('#retuas').value = ''
		datos = new FormData()
		datos.append('aaaa', mensaje)
		datos.append('bbbb', idCliente)
		urlDestino = `../ajax/ajaxChatsCliente.php`

		fetch(urlDestino, {
			method : 'post',
			body : datos
		})
		.then((respuesta) => respuesta.json())
		.then((respuesta) => {
			mostrarDatos(respuesta,tipo ='mensajes')
		});
		traerListaClienteChat()

	}else{
		console.log('Mensaje Vacio')
	}
}

function traerListaClienteChat(){
	listaChat = 'Hola';
	datos = new FormData()
	datos.append('listaChat', listaChat)
	urlDestino = `../ajax/ajaxChatsCliente.php`
	fetch(urlDestino, {
		method : 'post',
		body : datos
	})
	.then((respuesta) => respuesta.text())
	.then((respuesta) => {
		document.getElementById('listaChats').innerHTML = respuesta
	});

	
}