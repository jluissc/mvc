<?php   
	
	if ($peticionAjax) {
		require_once '../modelos/chatCUModelo.php';
	}else{
		require_once './modelos/chatCUModelo.php';
	}

	class chatCUControlador extends chatCUModelo  {

		public function lista_chatCU_C(){
			// session_start(['name' => 'bot']);
			$idEnvio = $_SESSION['id_bot'];
			$datos = chatCUModelo::lista_chatCU_M($idEnvio);

			$card = '';
			foreach ($datos as $key => $chat) {
				$cantNotif = chatCUModelo::cantNotiNoLeidasU_M($chat ->id_u,$idEnvio);
				// $estado = chatCUModelo::cantNotiNoLeidasU_M($chat ->id_u,$idEnvio,1);
				// var_dump($estado);
				$cant = $cantNotif -> rowCount() > 0 ? ($cantNotif -> rowCount())." Nuev. Mensj." : '' ;
				$activo =$cantNotif -> rowCount() > 0 ? "activeee" : '' ;
				// var_dump($cantNotif);
				$card .= ' 
					<a href="#" class="message-item d-flex align-items-center border-bottom px-3 py-2 mensa"  onclick="listarMensajeCU('.$chat ->id_u.')">
						<input type="hidden" value ="'.$chat ->id_u.'"> 
	                    <div class="user-img "><img src="'.$chat ->foto.'" alt="user" class="img-fluid rounded-circle"
	                        width="40px"> <span
	                        class="profile-status online float-right"></span>
	                    </div>
	                    <div class="w-75 d-inline-block v-middle pl-2 mensaje '.$activo .'">
	                        <h6 class="message-title mb-0 mt-1">'.$chat ->u_name.'</h6>
	                        <span class="font-12 text-nowrap d-block text-muted">...</span>
	                        <div id="cantNotif">
	                        	<span class="'.$activo .'" >'.$cant.'</span>
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