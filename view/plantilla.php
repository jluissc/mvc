<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="images/favicon.png" rel="shortcut icon">
	
    <title>
		<?php echo COMPANY?>
	</title>
	<?php 
		include "./view/inc/link.php"; 		
	?>
    
</head>
<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">
            <img class="preloader__img" src="<?php echo SERVERURL ?>view/images/preloader.png" alt="">
		</div>
    </div>

    <!--====== Main App ======-->
    <div id="app">	
	
		<?php 
			include "./view/inc/navBar.php"; 
			include "./view/inc/oferta.php"; 
			include "./view/inc/agregar_carrito_success.php"; 
			include "./view/inc/detalle-producto.php"; 
		?>
		<div class="container">
			<div class="row">
				<div class="col">
					
				</div>
				<div class="col">
					<div id="resulte" class="mb-3">
			
					</div>
				</div>
				<div class="col">
					
				</div>
			</div>
		</div>		
		
		<?php 
			$peticionAjax = false;			
			require_once "./controller/vistasCController.php"; 			
			$IV = new vistasCController();			
			$vistas = $IV -> obtener_vistas_C();
			// require_once 'inc/agregar_carrito_success.php';
			include $vistas;			
		?>
	
		<?php 
			include "./view/inc/footer.php"; 			
		?>
	</div>
	<?php 
		include "./view/inc/scrip.php"; 
	?>
<script>

	mostrarCarrito();
	leerUser();
	carrito = [];
	cart =false;
	loginMenu =false;
	sinTalla = ''
    serverURL = ''

	function verDetalle(id,tipo){
		serverURL = '<?php echo SERVERURL ?>'
		url = `${serverURL}ajax/productoAjax.php`;
		datos = new FormData();
		datos.append('id', id)
		fetch(url,{
			method : 'post',
			body : datos,
		})
		.then(r => r.json())
		.then(r => {
			if(tipo == 'carrito'){
				agregarCarrito3(r.producto)
			}else{
				mostrarModal(r.producto,r.empresa);
			}
		} 
		)
	}

	function imagenJS(){
		$modalProductDetailElement = $('#js-product-detail-modal')
        $modalProductDetailElementThumbnail = $('#js-product-detail-modal-thumbnail')
		if ($modalProductDetailElement.length && $modalProductDetailElementThumbnail.length) {
            $modalProductDetailElement.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite:false,
                arrows: false,
                dots: false,
                fade: true,
                asNavFor: $modalProductDetailElementThumbnail
            });

            $modalProductDetailElementThumbnail.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite:false,
                arrows: true,
                dots: false,
                focusOnSelect: true,
                asNavFor: $modalProductDetailElement,
                prevArrow:'<div class="pt-prev"><i class="fas fa-angle-left"></i>',
                nextArrow:'<div class="pt-next"><i class="fas fa-angle-right"></i>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
            // Hook into Bootstrap shown event and manually trigger 'resize' event
            // so that Slick recalculates the widths
            $('#quick-look').on('shown.bs.modal', function () {
                $modalProductDetailElement.resize();
            });
        }
	}
	
	function mostrarModal(datos, empresa){
		serverURL = '<?php echo SERVERURL ?>'
		stock = Math.floor(Math.random()*11)+1;
		
		if(datos.det_prod_tallas != 0){
			dattalla = datos.det_prod_tallas.split(',');
			tallas = `<div class="u-s-m-b-45">
						<div class="input-counter">	
							<select id="talla_p" class="form-select input-counter__text input-counter--text-primary-style" aria-label="Default select example">
								<option selected value="0">Talla</option>`
			dattalla.forEach(talla => {
				tallas += `<option value="${talla}">${talla}</option>`
			});
			tallas +=`</select></div></div>`
		}else{
			tallas = ''
			sinTalla = 'st'/* sin talla */
		}

		if(datos.det_prod_color != 0){
			datcolor = datos.det_prod_color.split(',');
			colores = `<div class="u-s-m-b-45">
						<div class="input-counter">
						<select id="color_p" class="form-select input-counter__text input-counter--text-primary-style" aria-label="Default select example">
							<option selected value="0">Color</option>`
			datcolor.forEach(color => {
				colores += `<option value="${color}">${color}</option>`
			});
			colores +=`</select></div></div>`
		}else{
			colores =``
		}

		altura = datos.det_prod_altura != 0 ? `<li><i class="fas fa-check-circle u-s-m-r-8"></i><span>Altura:  ${datos.det_prod_altura} cm</span></li>` : ''
		largo = datos.det_prod_largo != 0 ? `<li><i class="fas fa-check-circle u-s-m-r-8"></i><span>Largo:  ${datos.det_prod_largo} cm</span></li>` : ''
		peso = datos.det_prod_peso != 0 ? `<li><i class="fas fa-check-circle u-s-m-r-8"></i><span>Peso:  ${datos.det_prod_peso} K</span></li>` : ''
		ancho = datos.det_prod_ancho != 0 ? `<li><i class="fas fa-check-circle u-s-m-r-8"></i><span>Ancho:  ${datos.det_prod_ancho} cm</span></li>` : ''
		marca = datos.marca != 0 ? `<li><i class="fas fa-check-circle u-s-m-r-8"></i><span>Marca:  ${datos.marca}</span></li>` : ''
		modelo = datos.modelo != 0 ? `<li><i class="fas fa-check-circle u-s-m-r-8"></i><span>Modelo:  ${datos.modelo}</span></li>` : ''

		
		// descuento = Math.floor(Math.random()*30)+5;
		whatsapp = `https://api.whatsapp.com/send/?phone=%2B51${empresa.neg_telefono}&text=hola%20me%20interesa%20este%20producto%20${datos.prod_nombre}&app_absent=0`
		precioNormal = datos.descuent != 0  ? parseInt(datos.prod_precio)   : datos.prod_precio*1.25;
		precioDescuento = parseInt(datos.prod_precio)-parseInt(datos.descuent)
		div2 = `
				<div class="row">
                    <div class="col-lg-5">
                        
                        <div class="pd u-s-m-b-30">
                            <div class="pd-wrap">
                                <div id="js-product-detail-modal">
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_url}" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_p}" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_s}" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_t}" alt=""></div>
                                </div>
                            </div>
                            <div class="u-s-m-t-15">
                                <div id="js-product-detail-modal-thumbnail">
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_url}" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_p}" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_s}" alt=""></div>
                                    <div>

                                        <img class="u-img-fluid" src="${serverURL}admin/${datos.foto_t}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7" >
				<div class="pd-detail">
					<div>
						<span class="pd-detail__name" id="prod_name">${datos.prod_nombre}</span></div>
						<div>
						<div class="pd-detail__inline">

							<span class="pd-detail__price">S/. ${precioDescuento}.00</span>

							<span class="pd-detail__discount">(15% OFF)</span><del class="pd-detail__del">S/. ${precioNormal}</del></div>
					</div>
					
					<div class="u-s-m-b-15">
						<div class="pd-detail__inline">


							<span class="pd-detail__left">Solo quedan ${stock}</span></div>
					</div>
					<div class="u-s-m-b-15">

						<span class="pd-detail__preview-desc">${datos.prod_espec}</span>
						<ul class="pd-detail__policy-list">
							${marca}
							${modelo}
							${altura}
							${largo}
							${peso}
							${ancho}
						</ul>
					</div>
					
					
					<div class="u-s-m-b-15">
						<ul class="pd-social-list">
							<li>
								<a class="s-fb--color-hover" href="${empresa.neg_messeger}"  target="_bank"><i class="fab fa-facebook-f"></i></a>
							</li>							
							
							<li>
								<a class="s-wa--color-hover" href="${whatsapp}" target="_bank"><i class="fab fa-whatsapp"></i></a>
							</li>
							
						</ul>
					</div>
					<div class="u-s-m-b-15">
							<div class="pd-detail-inline-2">

								${tallas}
						
								${colores}	
							</div>
							<div class="pd-detail-inline-2">
								
								<div class="u-s-m-b-15">
									<div class="input-counter">
										<span class="input-counter__minus fas fa-minus" onclick="cantidadProd(false)"></span>

										<input class="input-counter__text input-counter--text-primary-style" 
										type="text" value="1" min="1" data-max="1000" id="cantPro">

										<span class="input-counter__plus fas fa-plus" onclick="cantidadProd(true)"></span>
									</div>
								</div>
								<div class="u-s-m-b-15">
									<button class="btn btn--e-brand-b-2" onclick="agregarCarrito(${datos.id_prod})">Agregar Carrito </button>
								</div>
							</div>
					</div>
					<div class="u-s-m-b-15">
						<div id="alerta">
							
						</div>
						<span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
						<ul class="pd-detail__policy-list">
							<li><i class="fas fa-check-circle u-s-m-r-8"></i>

								<span>Protección al comprador.</span></li>
							<li><i class="fas fa-check-circle u-s-m-r-8"></i>

								<span>Reembolso completo si no recibe su pedido.</span></li>
							<li><i class="fas fa-check-circle u-s-m-r-8"></i>

								<span>Se aceptan devoluciones si el producto no es como se describe.</span></li>
						</ul>
					</div>
					</div>
					<span class="pd-detail__stock"> Si tiene alguna duda, no dude en comunicarse <a target="_bank" href="https://api.whatsapp.com/send/?phone=51991509111&text=hola%20...&app_absent=0">aqui <i class="fab fa-whatsapp"></i></a></span>
				</div>
                </div>`;
		document.getElementById('detalleProdt').innerHTML = div2
		imagenJS()
	}

	function cantidadProd(tipo){
		cant = document.getElementById('cantPro').value
		if(cant <= 0){
			document.getElementById('cantPro').value = 1
			// return 0
		}else{
			suma = tipo ? +1 :-1
			document.getElementById('cantPro').value = parseInt(cant)+suma
		}
	}

	function agregarCarrito3(datos){
		// if(document.getElementById('color_p').value != 0){
			datos = {
				'id' : datos.id_prod,
				'nombre' : datos.prod_nombre,
				'cantidad' : parseInt(document.getElementById('cantPro').value),
				'precio' : datos.descuent == 0 ? datos.prod_precio : parseInt(datos.prod_precio)-parseInt(datos.descuent),
				'cat': datos.cat_nombre,
				'foto' : datos.foto_url,
				'talla' : sinTalla == 'st'  ? 'st'  :    document.getElementById('talla_p').value,
				'color' : document.getElementById('color_p').value,

			}
			if(JSON.parse(localStorage.getItem("pedidos"))){
				carrito = JSON.parse(localStorage.getItem("pedidos"))
				if (carrito.some( venta => venta.id == datos.id && venta.talla == datos.talla && venta.color == datos.color)) {
				
					const ventaExites = carrito.map( venta => {
						if( venta.id == venta.id == datos.id && venta.talla == datos.talla && venta.color == datos.color ) {
							venta.cantidad += datos.cantidad;
							return venta;
						} else {
							return venta;
						}
					})
					carrito = [...ventaExites];
				}else{
					carrito.push(datos);
				}
				
			}else{
				carrito.push(datos)
			}
			localStorage.setItem("pedidos",JSON.stringify(carrito))
			mostrarCarrito()
			alerta = `<h3 class="agregado-product">
									Tu producto fue agregado con exito al carrito!
								</h3>`
				document.getElementById('alerta').innerHTML = alerta
				setTimeout(()=>{
					document.getElementById('alerta').innerHTML = ''
					$('#quick-look').modal('hide')

				},2000)
			sinTalla = ''
		// }else{
		// 	console.log('sin color');
		// }
		
		
	}

	function mostrarCarrito(){
		serverURL = '<?php echo SERVERURL ?>'
		car =''
		cantP = 0
		if (localStorage.getItem("pedidos")) {
			
			carrito = JSON.parse(localStorage.getItem("pedidos"))
			if(carrito.length>0){
			cantP = carrito.length
			total = carrito.reduce((sum, li) => sum + li.cantidad*li.precio, 0)
			car = '<div class="mini-product-container gl-scroll u-s-m-b-15" >'
			// total = carrito.map()
			carrito.forEach(prod => {
				talla = prod.talla.toUpperCase()
				color = prod.color.toUpperCase()
				// <a href="shop-side-version-2.html">${prod.cat}</a></span>
		
			car += `<div class="card-mini-product">
							<div class="mini-product">
								<div class="mini-product__image-wrapper">

									<a class="mini-product__link" href="product-detail.html">

										<img class="u-img-fluid" src="${serverURL}/admin${prod.foto}" alt=""></a></div>
								<div class="mini-product__info-wrapper">

									<span class="mini-product__name"">

										<a href="#"></a>Talla: ${talla} - Color: ${color}</span>

									<span class="mini-product__name">

										<a href="#">${prod.nombre}</a></span>

									<span class="mini-product__quantity">${prod.cantidad} x</span>

									<span class="mini-product__price">S/. ${prod.precio}</span></div>
							</div>
							<a class="mini-product__delete-link far fa-trash-alt" onclick="eliminarProd('${prod.id}','${prod.talla}','${prod.color}')"></a>
						</div>`
			});
			car +=`
				</div>
				<!--====== End - Mini Product Container ======-->


				<!--====== Mini Product Statistics ======-->
				<div class="mini-product-stat">
					<div class="mini-total">

						<span class="subtotal-text">SUBTOTAL</span>

						<span class="subtotal-value">S/. ${total}</span></div>
					<div class="mini-action">

						<a class="mini-link btn--e-brand" href="#" onclick="verLogin()">PEDIR</a>
						</div>
				</div>`
			}else{
				car +=`<span class="subtotal-text"><strong>Tu carrito esta vacio</strong></span>`
			}
			
		} else {
			car +=`<span class="subtotal-text"><strong>Tu carrito esta vacio</strong></span>`	
		}
		document.getElementById('carrito_Luis').innerHTML = car	
		document.getElementById('cantPed').innerHTML = cantP
		document.getElementById('cantPed3').innerHTML = cantP
		// leerPedidos()
	}

	function eliminarProd(id, talla,color){
		
		carrito = JSON.parse(localStorage.getItem("pedidos"))
		articulosCarrito = carrito.filter(venta => venta.id != id);
		articulosCarrito = carrito.filter(venta => venta.talla != talla );
		articulosCarrito = carrito.filter(venta => venta.color != color);
		localStorage.setItem("pedidos",JSON.stringify(articulosCarrito))
		mostrarCarrito()
	}

	function agregarCarrito(id){
		console.log('sinTalla');
		console.log(id);
		// talla = document.getElementById('talla_p').value == ''  ? 'st'  :    document.getElementById('talla_p').value
		talla = sinTalla == 'st'  ? 'st'  :    document.getElementById('talla_p').value
		console.log(talla);
		if( talla == 0 || document.getElementById('color_p').value == 0){
			alerta = `<h3 class="agregado-error">
								Por favor selecciona una talla o color!
							</h3>`
			document.getElementById('alerta').innerHTML = alerta
			setTimeout(()=>{
				document.getElementById('alerta').innerHTML = ''

			},2000)
			// return 0
		}else{

			verDetalle(id,'carrito')
		}
	}

	function IniciarSession(){
		// e.preventDefault()
		serverURL = '<?php echo SERVERURL ?>'
		user = document.getElementById('user').value
		pass = document.getElementById('pass').value
		url = `${serverURL}ajax/logueoAjax.php`;
		datos = new FormData()
		datos.append('session','session')
		datos.append('user',user)
		datos.append('pass',pass)
		fetch(url,{
			method : 'post',
			body : datos,
		})
		.then(r => r.json())
		.then(r => {
			if (r != 'mal'){
				localStorage.setItem('user',JSON.stringify(r))
				$('#newsletter-modal').modal('hide');
				if (cart && !loginMenu){
					location.href =`${serverURL}detalles`
				}
				else if(loginMenu){
					location.reload();
				}
				leerUser()

			}else{
				console.log('mal datos');
				// document.getElementById('alertaloginn').innerHTML = 'Mal Datos'
				alertaHTML('error','Mal datosssss','alertaloginn')
				
			}
		})
	}
	// product
// error
	function alertaHTML(tipo, mensaje, idSelect){
		alerta = `<h3 class="agregado-${tipo}">
			<strong>${mensaje}</strong>
								</h3>`
		document.getElementById(idSelect).innerHTML = alerta
		setTimeout(() => {
			document.getElementById(idSelect).innerHTML = ''
			
		}, 2000);
	}
	function leerUser(){
		serverURL = '<?php echo SERVERURL ?>'
		div = ''
		tipo = ''
		if(localStorage.getItem('user')){
			user = JSON.parse(localStorage.getItem('user'))
			
			div+=`
			<li class="lista-cuenta">
					<span>${user.name} </span>	
				</li>
				<li class="lista-cuenta">
					<i class="fas fa-user-circle"></i>
						<span onclick="verCuenta()">Cuenta</span>
				</li>
				<li class="lista-cuenta">
					<a href="${serverURL}pedidos/"><i class="fas fa-cart-plus"></i>
						<span>Pedidos</span></a>
				</li>
				<li class="lista-cuenta">
					<i class="fas fa-lock-open u-s-m-r-6"></i>
						<span onclick="salir()">Salir</span>
				</li>`
		}else{
			div+=`
				<li class="lista-cuenta">					
					<i class="fas fa-user-circle u-s-m-r-6"></i> <span onclick="verLogin(true)">Login</span>	
				</li>
				<li class="lista-cuenta">
					<i class="fas fa-user-plus u-s-m-r-6"></i> <span>Registrar</span>
				</li>`
		}

		document.getElementById('loginUser').innerHTML = div
	}
	
	function salir(){
		localStorage.removeItem('user')
		leerUser()
	}
	
	function verLogin(valor=false){
		serverURL = '<?php echo SERVERURL ?>'
		if(localStorage.getItem('user')){
			location.href =`${serverURL}detalles`
		}else{
			$('#newsletter-modal').modal('show');
			cart = true;
			loginMenu = valor

		}
	}

	function buscarProducto(){
		serverURL = '<?php echo SERVERURL ?>'
		url = `${serverURL}ajax/productoAjax.php`
		search = document.getElementById('main-search').value;
		if(search.length >= 3){
			datos = new FormData()
			datos.append('search', search)
			fetch(url , {
				method : 'POST',
				body : datos
			})
			.then( datos => datos.json())
			.then( datos => {
				// if(datos.length>1){
				// 	document.getElementById("navigation2").innerHTML = ''
				// }
				res = `<ol id="lista3">`
				datos.forEach(prod => {
					res +=`<li><a href="${serverURL}categoria/${search}">${prod.prod_nombre} </a></li>`
				});
				res += `</ol>`
				document.getElementById('resulte').innerHTML = res
			})
		}else{
			document.getElementById('resulte').innerHTML = ''
			console.log('mas de 3 porfa');
		}
	}

	function verCuenta(){
		$('#cuentaLogueado').modal('show');
		serverURL = '<?php echo SERVERURL ?>'
		url = `${serverURL}ajax/logueoAjax.php`;
		if(localStorage.getItem('user')){
			user = JSON.parse(localStorage.getItem('user'))
            datos = new FormData()
            datos.append('ida',user.id)
            datos.append('usera',user.user)
            datos.append('tokena',user.token)
            datos.append('token2a',user.token2)
			datos.append('cuenta','cuenta')
			fetch(url,{
				method : 'post',
				body : datos,
			})
			.then(r => r.json())
			.then(r => {
				mostrarCuentaU(r)
			})
		}
	}
	function mostrarCuentaU(user){
		div = `
			<div class="u-s-m-b-15">
				<input class="news-l__input" id="name" type="text" placeholder="Nombres" value="${user.cli_nombre}">
			</div>
			<div class="u-s-m-b-15">
				<input class="news-l__input" id="last" type="text" placeholder="Apellidos" value="${user.cli_apellido}">
			</div>
			<div class="u-s-m-b-15">
				<input class="news-l__input" id="celphone" type="text" placeholder="Celular" value="${user.cli_celular}">
			</div>
			<div class="u-s-m-b-15">
				<input class="news-l__input" id="address" type="text" placeholder="Dirección" value="${user.cli_direccion}">
			</div>
			
			<div class="u-s-m-b-15">
				<button class="btn btn--e-brand"  onclick="editUser()">Editar</button>
			</div>
			<div class="u-s-m-b-15">
				<button class="btn btn--e-brand" data-dismiss="modal">Cancelar</button>
			</div>`

		document.getElementById('cuentaLogin').innerHTML = div
	}

	function editUser(){
		serverURL = '<?php echo SERVERURL ?>'
		url = `${serverURL}ajax/logueoAjax.php`;
		name = document.getElementById('name').value
		last = document.getElementById('last').value
		celphone = document.getElementById('celphone').value
		address = document.getElementById('address').value
		if(localStorage.getItem('user')){

			user = JSON.parse(localStorage.getItem('user'))
			datos = new FormData()
            datos.append('iduser',user.id)
            datos.append('user',user.user)
			datos.append('name',name)
			datos.append('last',last)
			datos.append('celphone',celphone)
			datos.append('address',address)
			datos.append('edit','edit')
			
			fetch(url,{
				method : 'post',
				body : datos,
			})
			.then(r => r.json())
			.then(r => {
				if(r!=0){
					localStorage.setItem('user',JSON.stringify(r))
					leerUser()
				}else{
					console.log('algo mal');
				}
			})
		}
	}
	
	function registrarseCliente(){
		nom_reg = document.getElementById('nom_reg').value
		user_reg = document.getElementById('user_reg').value
		pass_reg = document.getElementById('pass_reg').value

		if(nom_reg != '' &&  user_reg != '' &&  pass_reg != ''){
			serverURL = '<?php echo SERVERURL ?>'
			url = `${serverURL}ajax/logueoAjax.php`;
			user = JSON.parse(localStorage.getItem('user'))
			datos = new FormData()
			datos.append('nom_reg',nom_reg)
			datos.append('user_reg',user_reg)
			datos.append('pass_reg',pass_reg)
			fetch(url,{
				method : 'post',
				body : datos,
			})
			.then(r => r.json())
			.then(r => {
				if(r == 1){
					alertaHTML('product','Registrado correctamente','alertaloginn')
				}else{
					alertaHTML('error','Tu correo ya esta registrado o intenta con otro correo','alertaloginn')
				}
			})
			
		}else{
			alertaHTML('error','Campos vacios','alertaloginn')
		}
	}
	window.addEventListener("keyup", function(event){
		var codigo = event.keyCode || event.which;
		if (codigo == 27){
			$('#quick-look').modal('hide');
			document.getElementById('main-search').value = ''
			document.getElementById('resulte').innerHTML = ''
			

		}
	}, false);

	
</script>
</body>
</html>
<style>
	#loginUser {
    counter-reset: li; 
    list-style: none; 
    *list-style: decimal; 
    font: 15px 'trebuchet MS', 'lucida sans';
    padding: 0;
    margin-bottom: 4em;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
}

#loginUser ol {
    margin: 0 0 0 2em; 
}

#loginUser li{
    position: relative;
    display: block;
    padding: .4em .4em .4em .8em;
    *padding: .4em;
    margin: .5em 0 .5em 2.5em;
    background: #ddd;
    color: #444;
    text-decoration: none;
    transition: all .3s ease-out;   
}

#loginUser li:hover{
    background: #eee;
}   

#loginUser li:before{
    content: counter(li);
    counter-increment: li;
    position: absolute; 
    left: -2.5em;
    top: 50%;
    margin-top: -1em;
    background: #fa8072;
    height: 2em;
    width: 2em;
    line-height: 2em;
    text-align: center;
    font-weight: bold;
}

#loginUser li:after{
    position: absolute; 
    content: '';
    border: .5em solid transparent;
    left: -1em;
    top: 50%;
    margin-top: -.5em;
    transition: all .3s ease-out;               
}

#loginUser li:hover:after{
    left: -.5em;
    border-left-color: #fa8072;             
}

.agregado-product{
	background-color: #1FC500;
	color: black;
	border-radius: 20px;
}
.agregado-error{
	background-color: #CA3F45;
	color: white;
	border-radius: 20px;
}
</style>