<?php   
/* 
SELECT  DISTINCT id_cli FROM `chats_cli_tiend` as cct
				INNER JOIN usuario 
				ON cct.chct_id_usuario  = usuario.id_usu
				
				INNER JOIN cliente
				ON cct.chct_id_cliente = cliente.id_cli
				
				WHERE cct.chct_id_usuario = 1
				ORDER BY cct.chct_fecha DESC


				ARREGLAR EsTA CONSULTA
*/
	
	if ($peticionAjax) {
		require_once '../modelos/modeloChatCliente.php';
	}else{
		require_once './modelos/modeloChatCliente.php';
	}

	class controladorChatClientes extends modeloChatCliente  {

		public function listaChats_C(){
			// session_start(['name' => 'bot']);
			$idUsuario = $_SESSION['id_bot'];

			// traer los id's que tienen mensajes con esta tienda 
			$idClientes = modeloChatCliente::listarIdCliente($idUsuario);
			$div = '';
			$card = '';
			foreach ($idClientes as $key => $idCliente) {

				// traer datos del cliente
				$clientes = modeloChatCliente::mostrarDatosCliente($idCliente->id_cli);
				$mensaje = modeloChatCliente::mostrarUltimoMensajeCliente($idCliente->id_cli);
 
			
				// $cantNotif = chatCUModelo::cantNotiNoLeidasU_M($chat ->id_u,$idEnvio);
				// // $estado = chatCUModelo::cantNotiNoLeidasU_M($chat ->id_u,$idEnvio,1);
				// // var_dump($estado);
				// $cant = $cantNotif -> rowCount() > 0 ? ($cantNotif -> rowCount())." Nuev. Mensj." : '' ;
				// $activo =$cantNotif -> rowCount() > 0 ? "activeee" : '' ;
				// // var_dump($cantNotif);
				$card .= '

				<a href="#" class="message-item d-flex align-items-center border-bottom px-3 py-2"  onclick="traerChatCliente('.$clientes ->id_cli.')" >
	                <div class="user-img "><img src="../../admin/vistas/assets/images/clientes/'.$clientes ->cli_foto.'" alt="user" class="img-fluid rounded-circle"
	                    width="40px"> <span
	                    class="profile-status online float-right"></span>
	                </div>
	                <div class="w-75 d-inline-block v-middle pl-2 mensaje ds">
	                    <h6 class="message-title mb-0 mt-1">'.$clientes ->cli_nombre.'</h6>
	                    <span class="font-12 text-nowrap d-block text-muted">'.$mensaje->chct_mensaje.'</span>
	                    <div id="cantNotif">
	                    	<span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
	                    </div>
	                </div>
				</a>';
			}
			return $card;                         
		} 

		public function unic_chatCU_C(){
			session_start(['name' => 'bot']);
			$idEnvia = $_SESSION['id_bot'];
			$idRecibe = $_POST['chatUnico'];
			$datos = chatCUModelo::unic_chatCU_M($idRecibe,$idEnvia);
		}

		public function C_mostrarChatCliente(){
			session_start(['name' => 'bot']);
			$idUsuario = $_SESSION['id_bot'];
			$idCliente = $_POST['idCliente'];
			$datos = [
				'idUsuario' => $idUsuario,
				'idCliente' => $idCliente
			];
			$chats = modeloChatCliente::M_mostrarChatCliente($idCliente,$idUsuario);

		}

		public function C_enviarMensajeCliente2(){
			session_start(['name' => 'bot']);
			$idUsuario = $_SESSION['id_bot'];
			$idCliente = $_POST['bbbb'];
			$mandarMensaje = $_POST['aaaa'];
			$datos = [
				'idUsuario' => $idUsuario,
				'idCliente' => $idCliente,
				'mandarMensaje' => $mandarMensaje,
				'envio' => 1,
				'estado' => 0
			];
			$chats = modeloChatCliente::M_mostrarChatCliente2($datos);

		}

		public function C_listaClientes(){
			session_start(['name' => 'bot']);
			$idUsuario = $_SESSION['id_bot'];
			// listaChats_C();

			// $chats = modeloChatCliente::M_listaClientes($idUsuario);

			// session_start(['name' => 'bot']);
			// $idUsuario = $_SESSION['id_bot'];

			// traer los id's que tienen mensajes con esta tienda 
			$idClientes = modeloChatCliente::listarIdCliente($idUsuario);
			$div ='';
				$card = '';
			foreach ($idClientes as $key => $idCliente) {

				// traer datos del cliente
				$clientes = modeloChatCliente::mostrarDatosCliente($idCliente->id_cli);
				$mensaje = modeloChatCliente::mostrarUltimoMensajeCliente($idCliente->id_cli);

				$div .= $clientes->id_cli;
				$div .= $clientes->cli_nombre;


				// $cantNotif = chatCUModelo::cantNotiNoLeidasU_M($chat ->id_u,$idEnvio);
				// // $estado = chatCUModelo::cantNotiNoLeidasU_M($chat ->id_u,$idEnvio,1);
				// // var_dump($estado);
				// $cant = $cantNotif -> rowCount() > 0 ? ($cantNotif -> rowCount())." Nuev. Mensj." : '' ;
				// $activo =$cantNotif -> rowCount() > 0 ? "activeee" : '' ;
				// // var_dump($cantNotif);
				$card .= '

				<a href="#" class="message-item d-flex align-items-center border-bottom px-3 py-2"  onclick="traerChatCliente('.$clientes ->id_cli.')" >
	                <div class="user-img "><img src="../../admin/vistas/assets/images/clientes/'.$clientes ->cli_foto.'" alt="user" class="img-fluid rounded-circle"
	                    width="40px"> <span
	                    class="profile-status online float-right"></span>
	                </div>
	                <div class="w-75 d-inline-block v-middle pl-2 mensaje ds">
	                    <h6 class="message-title mb-0 mt-1">'.$clientes ->cli_nombre.'</h6>
	                    <span class="font-12 text-nowrap d-block text-muted">'.$mensaje->chct_mensaje.'</span>
	                    <div id="cantNotif">
	                    	<span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
	                    </div>
	                </div>
				</a>';
			}
			return $card;

		}

		public function C_enviarMensajeCliente(){
			session_start(['name' => 'bot']);
			$idUsuario = $_SESSION['id_bot'];
			$idCliente = $_POST['idCliente'];
			$mensaje = $_POST['mensaje'];
			$datos = [
				'mensaje' => $mensaje,
				'envio' => 1,
				'estado' => 0,
				'cliente' => $idCliente,
				'usuario' => $idUsuario
			];
			$chats = modeloChatCliente::M_enviarMensajeCliente($datos);

		}
		
		public function registrarMensaje_chatCU_C(){
			
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

			$repuesta = chatCUModelo::registrarMensaje_chatCU_M($datos);
			
		}

		public function cant_Chat_C(){
			$idEnvio = $_SESSION['id_bot'];
			$datos = chatCUModelo::cant_Chat_M($idEnvio);
			$cant = $datos -> rowCount() > 0 ? ($datos -> rowCount())." Chats" : '' ;
			$li = '<li class="sidebar-item"> 
						<a class="sidebar-link sidebar-link" href="'.SERVERURL.'chat-ca/" aria-expanded="false"> 
							<i data-feather="message-square" class="feather-icon"></i>
							<span class="hide-menu">Chat Clientes '.$cant.'</spx	an>
						</a>
					</li>';
			return $li;
		}
		public function cant_Chat_C2(){
			$idEnvio = $_SESSION['id_bot'];
			$datos = chatCUModelo::cant_Chat_M($idEnvio);
			$cant = $datos -> rowCount() > 0 ? ($datos -> rowCount())." Chats" : '' ;
			$li = '<a class="dropdown-item"href="'.SERVERURL.'chat-ca/">
                            <i data-feather="mail" class="svg-icon mr-2 ml-1"></i>
                            Mensajes '.$cant.'
                        </a>';
			return $li;
		}
	} 