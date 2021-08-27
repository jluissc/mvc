 <?php 
	
	require_once 'mainModelo.php';

	class modeloChatCliente extends mainModelo {

		protected static function registrarMensaje_chatCU_M($datos) {
			$sql=mainModelo::conexion()->prepare("INSERT INTO `message_user_user`(`muu_message`, `muu_destino`, `u_id_u`,muu_status) VALUES (:mensaje , :idR, :idE, :status)");
			$sql->bindParam(":mensaje",$datos['mensaje']);
			$sql->bindParam(":idR",$datos['idRec']);
			$sql->bindParam(":idE",$datos['idEnv']);
			$sql->bindParam(":status",$datos['status']);
			$sql->execute();
			// return $sql;
			chatCUModelo::unic_chatCU_M($datos['idRec'],$datos['idEnv']);
			$sql = null;
		} 


		protected static function listarIdCliente($idUsuario) {
			$sql = mainModelo::conexion() ->prepare("SELECT  DISTINCT id_cli FROM `chats_cli_tiend` 
				INNER JOIN usuario 
				ON chats_cli_tiend.chct_id_usuario  = usuario.id_usu
				
				INNER JOIN cliente
				ON chats_cli_tiend.chct_id_cliente = cliente.id_cli
				
				WHERE chats_cli_tiend.chct_id_usuario = $idUsuario
				ORDER BY chats_cli_tiend.chct_fecha DESC");
			$sql -> execute();
			$listChat = $sql->fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $listChat;			
		} 


		protected static function mostrarDatosCliente($id) {
			$sql = mainModelo::conexion() ->prepare("
				SELECT * FROM `cliente` WHERE id_cli = $id");
			$sql -> execute();
			$cliente = $sql->fetch(PDO::FETCH_OBJ);
			$sql = null;
			return $cliente;
		}

		protected static function mostrarUltimoMensajeCliente($id) {
			$sql = mainModelo::conexion() ->prepare("
				SELECT * FROM `chats_cli_tiend` 
				WHERE chats_cli_tiend.chct_id_cliente = $id
				ORDER BY chats_cli_tiend.id_chct DESC
				LIMIT 1");
			$sql -> execute();
			$cliente = $sql->fetch(PDO::FETCH_OBJ);
			$sql = null;
			return $cliente;
		}




		protected static function M_mostrarChatCliente($idCliente,$idUsuario) {
			$sql = mainModelo::conexion() ->prepare("SELECT * FROM `chats_cli_tiend` WHERE chct_id_cliente = $idCliente AND chct_id_usuario =$idUsuario");
			
			$sql -> execute();
			$listaM = $sql->fetchAll(PDO::FETCH_ASSOC);
			array_push($listaM, ['idCliente'=>$idCliente,'idUsuario'=>$idUsuario]);
			$sql = null;
			exit(json_encode($listaM));
		}

		protected static function M_enviarMensajeCliente($datos) {
			$sql = mainModelo::conexion() ->prepare("INSERT INTO `chats_cli_tiend` ( `chct_mensaje`, `chct_envio`, `chct_estado`, `chct_id_cliente`, `chct_id_usuario`) VALUES (:mensaje, :envio, :estado, :cliente, :usuario);");
			$sql->bindParam(":mensaje",$datos['mensaje']);
			$sql->bindParam(":envio",$datos['envio']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":cliente",$datos['cliente']);
			$sql->bindParam(":usuario",$datos['usuario']);
			$sql -> execute();

			modeloChatCliente::M_mostrarChatCliente($datos['cliente'],$datos['usuario']);
			
			// exit(json_encode($listaM));
		}

		protected static function M_mostrarChatCliente2($datos) {
			$sql = mainModelo::conexion() ->prepare("INSERT INTO `chats_cli_tiend` ( `chct_mensaje`, `chct_envio`, `chct_estado`, `chct_id_cliente`, `chct_id_usuario`) VALUES (:mensaje, :envio, :estado, :cliente, :usuario);");
			$sql->bindParam(":mensaje",$datos['mandarMensaje']);
			$sql->bindParam(":envio",$datos['envio']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":cliente",$datos['idCliente']);
			$sql->bindParam(":usuario",$datos['idUsuario']);
			$sql -> execute();

			modeloChatCliente::M_mostrarChatCliente($datos['idCliente'],$datos['idUsuario']);
			
			// exit(json_encode($listaM));
		}

		protected static function lista_chatCU_M($id) {
			$sql = mainModelo::conexion() ->prepare("
				SELECT * FROM `cliente` WHERE u_status = 1 AND id_u != $id");
			$sql -> execute();
			$listChat = $sql->fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $listChat;
		}

		protected static function actualizarNotificaciones_M($idEn,$idR){
			$sql = mainModelo::conexion() -> prepare("UPDATE message_user_user SET muu_status = 1 WHERE muu_destino  IN($idEn,$idR) AND u_id_u IN($idEn,$idR) AND u_id_u = $idR");
			$sql -> execute();
			return $sql;
			$sql = null;
		}

		protected static function unic_chatCU_M($idR,$idE) {

			$noti = chatCUModelo::actualizarNotificaciones_M($idE,$idR);

			$sql = mainModelo::conexion() -> prepare("SELECT u.foto,muu.u_id_u,muu.muu_message,muu.sTime,muu.muu_status FROM message_user_user AS muu 
				INNER JOIN user AS u
                ON muu.u_id_u = u.id_u
				WHERE muu.muu_destino IN($idR,$idE) AND muu.u_id_u IN($idR,$idE) ORDER BY muu.sTime ASC ");
			$sql -> execute();
			$listaM = $sql->fetchAll(PDO::FETCH_ASSOC);
			array_push($listaM, ['idE'=>$idE,'idD'=>$idR]);
			$sql = null;
			exit(json_encode($listaM));
		}

		protected static function cantNotiNoLeidasU_M($id,$env,$o=0){
			$sql = mainModelo::conexion() -> prepare("SELECT muu_message,muu_status FROM message_user_user WHERE ((muu_destino IN($id,$env) AND u_id_u IN($id,$env)) OR (muu_destino IN($env,$id) AND u_id_u IN($env,$id))) AND muu_destino = $env AND muu_status = 0");
			$sql -> execute();
			if ($o==1) {
				$listChat = $sql->fetchAll(PDO::FETCH_OBJ);
				return $listChat;
			}else{

				return $sql;
			}
			$sql = null;
		}

		protected static function cant_Chat_M($id){
			$sql = mainModelo::conexion() -> prepare("SELECT DISTINCT muu.u_id_u FROM 	`message_user_user`  AS muu
					INNER JOIN user AS u
					ON muu.muu_destino = u.id_u
					WHERE u.id_u = $id AND muu.muu_status =0");
			$sql -> execute();
			return $sql;			
			$sql = null;
		}

		
	}   