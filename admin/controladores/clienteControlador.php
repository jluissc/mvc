<?php  
	
	if ($peticionAjax) {
		require_once '../modelos/clienteModelo.php';
	}else{
		require_once './modelos/clienteModelo.php';
	}

	class clienteControlador extends clienteModelo	{
		
		public function agregar_cliente_C(){


// 			code
// name
// last
// status
// celphone
// adress
			$code=mainModelo::limpiar_cadena($_POST['cliente_dni_reg']);
			$name=mainModelo::limpiar_cadena($_POST['cliente_nombre_reg']);
			$last=mainModelo::limpiar_cadena($_POST['cliente_apellido_reg']);
			// $status=mainModelo::limpiar_cadena($_POST['usuario_telefono_reg']);
			$celphone=mainModelo::limpiar_cadena($_POST['cliente_telefono_reg']);
			$adress=mainModelo::limpiar_cadena($_POST['cliente_direccion_reg']);
			// $email=mainModelo::limpiar_cadena($_POST['usuario_email_reg']);
			// $clave1=mainModelo::limpiar_cadena($_POST['usuario_clave_1_reg']);
			// $clave2=mainModelo::limpiar_cadena($_POST['usuario_clave_2_reg']);
			// $privilegio=mainModelo::limpiar_cadena($_POST['usuario_privilegio_reg']);

			/*== comprobar campos vacios ==*/
			if($name=="" || $last=="" || $celphone=="" || $code==""){
				$alerta=[
					"Alerta" => "simple",
					"Titulo" => "Ocurrió un error inesperado",
					"Texto" => "No has llenado datos basicos de registro",
					"Tipo" => "error"
				];
				echo json_encode($alerta);
				exit();

			}
			/*== Verificando integridad de los datos ==*/
			if(mainModelo::verificar_datos("[0-9-]{1,20}",$code)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El DNI no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}",$name)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}",$last)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El apellido no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			if($telefono!=""){
				if(mainModelo::verificar_datos("[0-9()+]{8,20}",$celphone)){
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El telefono no coincide con el formato solicitado",
						"Tipo"=>"error"
					];
					echo json_encode($alerta);
					exit();
				}
			}

			if($direccion!=""){
				if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$adress)){
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La direccion no coincide con el formato solicitado",
						"Tipo"=>"error"
					];
					echo json_encode($alerta);
					exit();
				}
			}

			// if(mainModelo::verificar_datos("[a-zA-Z0-9]{1,35}",$usuario)){
			// 	$alerta=[
			// 		"Alerta"=>"simple",
			// 		"Titulo"=>"Ocurrió un error inesperado",
			// 		"Texto"=>"El usuario no coincide con el formato solicitado",
			// 		"Tipo"=>"error"
			// 	];
			// 	echo json_encode($alerta);
			// 	exit();
			// }

			// if(mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
			// 	$alerta=[
			// 		"Alerta"=>"simple",
			// 		"Titulo"=>"Ocurrió un error inesperado",
			// 		"Texto"=>"Las claves no coinciden con el formato solicitado",
			// 		"Tipo"=>"error"
			// 	];
			// 	echo json_encode($alerta);
			// 	exit();
			// }

			$check_code= mainModelo::ejecutar_consulta_simple("SELECT * FROM customer WHERE c_code = '$code' ");
			if ($check_code -> rowCount()>0) {
			 	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El Dni ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			 }
			// // $check usuaer= mainModelo::ejecutar()
			// $check_user= mainModelo::ejecutar_consulta_simple("SELECT u_user FROM user WHERE u_user = '$usuario' ");
			// if ($check_user -> rowCount()>0) {
			//  	$alerta=[
			// 		"Alerta"=>"simple",
			// 		"Titulo"=>"Ocurrió un error inesperado",
			// 		"Texto"=>"El usuario ya existe",
			// 		"Tipo"=>"error"
			// 	];
			// 	echo json_encode($alerta);
			// 	exit();
			//  }
			// // $check email= mainModelo::ejecutar()
			// if ($email !="") {
			// 	if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
			// 		$check_email= mainModelo::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email = '$email' ");
			// 		if ($check_email -> rowCount()>0) {
			// 		 	$alerta=[
			// 				"Alerta"=>"simple",
			// 				"Titulo"=>"Ocurrió un error inesperado",
			// 				"Texto"=>"El gmail ya existe",
			// 				"Tipo"=>"error"
			// 			];
			// 			echo json_encode($alerta);
			// 			exit();
			// 		 }
			// 	} else {
			// 		$alerta=[
			// 			"Alerta"=>"simple",
			// 			"Titulo"=>"Ocurrió un error inesperado",
			// 			"Texto"=>"El email no correcto",
			// 			"Tipo"=>"error"
			// 		];
			// 		echo json_encode($alerta);
			// 		exit();
			// 	}
				
			// } 

			// if ($clave1!=$clave2) {
			// 	$alerta=[
			// 			"Alerta"=>"simple",
			// 			"Titulo"=>"Ocurrió un error inesperado",
			// 			"Texto"=>"Las claves no coinciden",
			// 			"Tipo"=>"error"
			// 		];
			// 		echo json_encode($alerta);
			// 		exit();
			// } 
			// else{
			// 	$clave = mainModelo::encryption($clave1);
			// }

			// if ($privilegio <1 || $privilegio > 3) {
			// 	$alerta=[
			// 			"Alerta"=>"simple",
			// 			"Titulo"=>"Ocurrió un error inesperado",
			// 			"Texto"=>"El privilegio no correcto",
			// 			"Tipo"=>"error"
			// 		];
			// 		echo json_encode($alerta);
			// 		exit();
			// }
			
			$datos = [
				"code" => $code,
				"name" => $name,
				"last" => $last,
				"status" => 1,
				"celphone" => $celphone,
				"adress" => $adress
			];
			$agregarC = clienteModelo::agregar_cliente_M($datos);

			if($agregarC -> rowCount() == 1){
				$alerta=[
					"Alerta"=>"limpiar",
					"Titulo"=>"Datos Guardados",
					"Texto"=>"Datos Guardar",
					"Tipo"=>"success"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un problemsa",
					"Texto"=>"No se pudo guardar el usuarios, intentalo de nuevo",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		
		}
	} 