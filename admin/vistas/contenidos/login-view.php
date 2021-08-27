

<?php  

if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
	if ($_POST['usuario_log'] === '' && $_POST['clave_log'] === '' ) {
		echo '<script>
		console.log("Credenciales Vacias")
		</script>';
	} else {
		require_once './controladores/loginControlador.php';
		$inst = new loginControlador();
		echo $inst -> iniciar_sesion_C();
	}
	
}
?>

<div class="alert alert-secondary text-center" role="alert" >
	Crea tu tienda y envianos un mensaje al 991509111 para poder activarlo o click <a target="_bank" href="https://api.whatsapp.com/send?phone=+519915091118&text=Hola%20quiero%20activar%20mi%20tienda"><strong>AQUI</strong></a>					
</div>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?php echo SERVERURL ?>vistas/assets/images/big/auth-bg.jpg) no-repeat center center;">
	<div class="auth-box row">
		<div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(<?php echo SERVERURL ?>vistas/assets/images/login/2.jpg);">
		</div>
		<div class="col-lg-5 col-md-7 bg-white">
			<div class="p-3">
				<div class="text-center">
					<img src="<?php echo SERVERURL ?>vistas/assets/images/big/icon.png" alt="wrapkit">
				</div>
				<h2 class="mt-3 text-center">Iniciar Sessión</h2>
				<!-- <p class="text-center">Enter your email address and password to access admin panel.</p> -->
				<form action="" method="POST" autocomplete="off" >
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text-dark" for="uname">Usuario</label>
								<input class="form-control" name="usuario_log" type="text"
								placeholder="enter your username">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text-dark" for="pwd">Contraseña</label>
								<input class="form-control" name="clave_log" type="password"
								placeholder="enter your password">
							</div>
						</div>
						<div class="col-lg-12 text-center">
							<button type="submit" class="btn btn-block btn-dark">Iniciar</button>
						</div>
						<br>
						<br>
						<div class="text-center">
							<i><a href="#" data-toggle="modal" data-target="#newProductos" @click="listarCategorias()">Crear mi tienda online gratis</a></i>
						</div>
						<!-- <input type="button" name="newProduc" class="btn btn-success" value="Nuevo Producto" data-toggle="modal" data-target="#newProductos" @click="listarCategorias()"> -->
						<!-- REgistrarrse -->
						<!-- <div class="col-lg-12 text-center mt-5">
							Don't have an account? <a href="#" class="text-danger">Sign Up</a>
						</div> -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	<div class="modal fade" id="newProductos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title te" id="myModalLabel">Crear mi tienda online</h4>
                    <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
                </div>                
				
				<div class="modal-body">
					<div class="card">
						<div class="row">
							<div class="col-md-6">
								<h4 class="card-title"><label for="name_reg">Nombre del negocio</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="name_reg"  placeholder="Nombre Producto" >

								</div>
							</div>

							<div class="col-md-6">
								<h4 class="card-title"><label for="rubro_reg">Rubro</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="rubro_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<!-- <div class="col-md-6">
								<h4 class="card-title"><label for="desc_reg">Descripción</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="desc_reg" placeholder="Nombre Producto" >

								</div>
							</div> -->
							<div class="col-md-6">
								<h4 class="card-title"><label for="addres_reg">Dirección</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="addres_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title"><label for="tel_reg">Telefono o Celular</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="tel_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<!-- <div class="col-md-6">
								<h4 class="card-title"><label for="url_reg">Messenger(url/link)</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="url_reg" placeholder="Nombre Producto" >

								</div>
							</div> -->
							<div class="col-md-12 text-center"> <hr style="background-color: blue;">
								<h2>Cree sus datos de usuario para poder entrar a la plataforma</h2>
							</div>
							<div class="col-md-6">
								<h4 class="card-title"><label for="nombres_reg">Nombres</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="nombres_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title"><label for="apell_reg">Apellidos</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="apell_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<div class="col-md-6">
								<h4 class="card-title"><label for="email_reg">Email</label></h4>
								
								<div class="form-group">
									<input type="text" class="form-control" id="email_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<div class="col-md-6">
								<h5 class="card-title"><label for="pass_reg">Contraseña</label></h5>
								
								<div class="form-group">
									<input type="text" class="form-control" id="pass_reg" placeholder="Nombre Producto" >

								</div>
							</div>
							<div class="col-md-12 text-center"> <hr style="background-color: blue;">
							</div>
							<a href=""></a>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="reset" class="btn btn-light" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary" onclick="crearTienda()">Crear ahora</button>
				</div>
				<div id="alert">
				</div>
            </div>
        </div>
    </div>

<script>
	function crearTienda(){
		let name_reg = document.getElementById('name_reg').value;
		let rubro_reg = document.getElementById('rubro_reg').value;
		let tel_reg = document.getElementById('tel_reg').value;
		// let desc_reg = document.getElementById('desc_reg').value;
		let desc_reg = "";
		let addres_reg = document.getElementById('addres_reg').value;
		// let url_reg  = document.getElementById('url_reg').value;
		let url_reg  = "";
		let nombres_reg = document.getElementById('nombres_reg').value;
		let apell_reg = document.getElementById('apell_reg').value;
		let email_reg = document.getElementById('email_reg').value;
		let pass_reg = document.getElementById('pass_reg').value;
		
		if (name_reg =="" && rubro_reg == "" && tel_reg =="" ) {
			console.log('falta datos')
		} else if(nombres_reg == "" && email_reg == "" && pass_reg == ""){
			console.log('falta datos')

		}else {
			let url= "../admin/controladores/tienda.php";
			let datos = new FormData();
            datos.append('name_reg',name_reg);
            datos.append('rubro_reg',rubro_reg);
            datos.append('tel_reg',tel_reg);
            datos.append('desc_reg',desc_reg);
            datos.append('addres_reg',addres_reg);
            datos.append('url_reg',url_reg);
            datos.append('nombres_reg',nombres_reg);
            datos.append('apell_reg',apell_reg);
            datos.append('email_reg',email_reg);
            datos.append('pass_reg',pass_reg);
			fetch(url,{
				method:'POST',
				body: datos
			})
			.then(respuesta => respuesta.text())
			.then(respuesta => {
				if (respuesta == "ok") {
					numero = `https://api.whatsapp.com/send?phone=+519915091118&text=Hola%20quiero%20activar%20mi%20tienda%20con%20el%20correo%20${email_reg}%20y%20nombre%20de%20mi%20tienda:%20${name_reg}`;
					alert = `
						<div class="alert alert-secondary" role="alert">
							Tu tienda se creo satisfactoriamente, dale click <a target="_bank" href="${numero}"><strong>AQUI</strong></a> para activar tu tienda.
						</div>`;
					document.getElementById('alert').innerHTML = alert;
					setTimeout(()=>{
						document.getElementById('alert').innerHTML = "";
						name_reg  = "";
						rubro_reg    = "";              
						tel_reg = "";
						desc_reg = "";
						addres_reg = "";
						url_reg = "";
						nombres_reg = "";
						apell_reg = "";
						email_reg = "";
						pass_reg = "";
						$('#newProductos').modal('hide');
					},60000)
				} else {
					alert = `<div class="alert alert-danger" role="alert">
							Intentalo nuevamente por favor
						</div>`;
					document.getElementById('alert').innerHTML = alert;
					setTimeout(()=>{
						document.getElementById('alert').innerHTML = "";
					},3000)
				}
			})
		}
		


	}
</script>

<!-- $tienda = [
        "name_reg" => $_POST['name_reg'],
        "rubro_reg" => $_POST['rubro_reg'],
        "tel_reg" => $_POST['tel_reg'],
        "desc_reg" => $_POST['desc_reg'],
        "addres_reg" => $_POST['addres_reg'],
        "url_reg" => $_POST['url_reg'],
    ];
    // $usuario = [
    //     "name_reg"=> $name_reg,
    //     "rubro_reg"=> $rubro_reg,
    //     "tel_reg"=> $tel_reg,
    //     "desc_reg"=> $desc_reg,
    //     "addres_reg"=> $addres_reg,
    //     "url_reg"=> $url_reg,
    // ];
    echo var_dump($tienda); -->


	<!-- pep2
	)]z{5q}{ou^M -->