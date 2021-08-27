<?php   
	
	if ($peticionAjax) {
		require_once '../modelos/chatUUModelo.php';
	}else{
		require_once './modelos/chatUUModelo.php';
	}

	class chatUUControlador extends chatUUModelo  {
		
		public function registrarMensaje_chatUU_C(){
			
			session_start(['name' => 'bot']);
			$idEnvio = $_SESSION['id_bot'];
			$idRecib =  $_POST['idRec'];
			$mensajeEnv = $_POST['mensajeEnv'];
			$datos = [
				"mensaje" => $mensajeEnv,
				"idRec" => $idRecib,
				"idEnv" => $idEnvio,
				"status" => 0
			];

			$repuesta = chatUUModelo::registrarMensaje_chatUU_M($datos);
			if($repuesta -> rowCount() == 1){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Dato Eliminado",
					"Texto"=>"La categoria fue eliminado",
					"Tipo"=>"success"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un problema",
					"Texto"=>"Comuniquese con su proveedor",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
			
		}


		public function lista_chatUU_C(){

			$idEnvio = $_SESSION['id_bot'];
			$datos = chatUUModelo::lista_chatUU_M($idEnvio);

			$card = '';
			foreach ($datos as $key => $chat) {
				$cantNotif = chatUUModelo::cantNotiNoLeidasU_M($chat ->id_u, $idEnvio);
				
				$mensaje = chatUUModelo::mensaje_Chat($chat ->id_u, $idEnvio);

				// if(  ) {
				// 	echo "war VACIO";	
				// }else{
				// 	echo "no vacio";
				// }

				if (is_array($mensaje)) {

					$cant = $cantNotif -> rowCount() > 0 ? $cantNotif -> rowCount() : '' ;

					$fechaOriginal = $mensaje['muu_fecha'];
					$fechaFormateada = date("g:i:s", strtotime($fechaOriginal));

					$mensaje = $mensaje['muu_message'] != '' ? $mensaje['muu_message'] : '';
					$opcion = $cantNotif -> rowCount() > 0 ? 'Tienes '.$cant.' nuevos' : $mensaje;
					$estado = $cant > 0 ? 'activeee' : '';
 
					$card .= ' 
					<a href="#" class="message-item d-flex align-items-center border-bottom px-3 py-2"  >
						<input type ="hidden" name="iduser" value = '.$chat->id_u.'> 
						<div class="user-img"><img src="'.$chat ->foto.'" alt="user" class="img-fluid rounded-circle" width="40px"> 
							<span class="profile-status online float-right"></span>
						</div>
						<div class="w-75 d-inline-block v-middle pl-2 ">
							<h6 class="message-title mb-0 mt-1 '.$estado.'">'.$chat->u_name.'</h6>
							<span class="font-12 text-nowrap d-block text-muted  ">'.$opcion.'</span>
							<span class="font-12 text-nowrap d-block text-muted  ">'.$fechaFormateada.'</span>
						</div>

					</a>';
				}else{

					$card .= ' 
					<a href="#" class="message-item d-flex align-items-center border-bottom px-3 py-2"  >
						<input type ="hidden" name="iduser" value = '.$chat->id_u.'> 
						<div class="user-img"><img src="'.$chat ->foto.'" alt="user" class="img-fluid rounded-circle" width="40px"> 
							<span class="profile-status online float-right"></span>
						</div>
						<div class="w-75 d-inline-block v-middle pl-2">
							<h6 class="message-title mb-0 mt-1">'.$chat->u_name.'</h6>
							<span class="font-12 text-nowrap d-block text-muted"></span>
						</div>

					</a>';
				}

				
			}
			return $card;
		}

		public function unic_chatUU_C(){
			session_start(['name' => 'bot']);
			$idEnvio = $_SESSION['id_bot'];

			$datos = chatUUModelo::unic_chatUU_M($_POST['idListaM'],$idEnvio);
		}


		
	} 