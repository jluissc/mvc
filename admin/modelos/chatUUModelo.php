 <?php 
	
	require_once 'mainModelo.php';
	class chatUUModelo extends mainModelo {

		protected static function registrarMensaje_chatUU_M($datos) {
			$sql=mainModelo::conexion()->prepare("INSERT INTO `message_user_user`(`muu_message`, `muu_destino`, `u_id_u`,muu_status) VALUES (:mensaje , :idR, :idE, :status)");
			$sql->bindParam(":mensaje",$datos['mensaje']);
			$sql->bindParam(":idR",$datos['idRec']);
			$sql->bindParam(":idE",$datos['idEnv']);
			$sql->bindParam(":status",$datos['status']);
			$sql->execute();
			return $sql;
			// chatUUModelo::unic_chatUU_M($datos['idRec'],$datos['idEnv']);
			$sql = null;
		}


		protected static function lista_chatUU_M($id) {
			$sql = mainModelo::conexion() -> 
			prepare("
				SELECT DISTINCT u_name, id_u, u.foto FROM user AS u WHERE id_u != $id ");
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

		protected static function unic_chatUU_M($id,$env) {

			$noti = chatUUModelo::actualizarNotificaciones_M($env,$id);

			$sql = mainModelo::conexion() -> prepare("SELECT muu.muu_message, muu.muu_fecha,  u.id_u,u.foto  FROM message_user_user AS muu 
				INNER JOIN user AS u
                ON muu.u_id_u = u.id_u
				WHERE muu.muu_destino IN($id,$env) AND muu.u_id_u IN($id,$env) ORDER BY muu.id_muu ASC");
			$sql -> execute();
			$listaM = $sql->fetchAll(PDO::FETCH_ASSOC);
			array_push($listaM, ['idE'=>$env,'idD'=>$id]);
			$sql = null;
			exit(json_encode($listaM));
		}

		protected static function mensaje_Chat($id,$env) {
			$sql = mainModelo::conexion() -> prepare("SELECT u.id_u, u.foto, muu.muu_message, muu.muu_fecha, u.u_name FROM message_user_user AS muu INNER JOIN user AS u ON muu.u_id_u = u.id_u WHERE muu.muu_destino  IN($id,$env)AND muu.u_id_u IN($id,$env) ORDER BY muu.id_muu DESC LIMIT 1 ");
			$sql -> execute();
			$mensaje = $sql->fetch();
			$sql = null;
			return $mensaje;
		}

		protected static function cantNotiNoLeidasU_M($id,$env){
			$sql = mainModelo::conexion() -> prepare("SELECT id_muu FROM message_user_user WHERE muu_destino IN($id,$env) AND u_id_u IN($id,$env) AND u_id_u = $id AND muu_status = 0");
			$sql -> execute();
			return $sql;
			$sql = null;
		}

		protected static function listaChatSinMensajes_M($idEnv){
			$sql = mainModelo::conexion() -> prepare("SELECT DISTINCT u.u_name, u.foto,u.id_u FROM user AS u
				INNER JOIN message_user_user AS muu
				ON u.id_u != muu.muu_destino
				WHERE u.id_u != $idEnv");
			$sql -> execute();
			$listChat = $sql->fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $listChat;
		}

		
	}  