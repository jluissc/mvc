 <?php 
	
	require_once 'mainModelo.php';
	class chatCUModelo extends mainModelo {

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


		protected static function lista_chatCU_M($id) {
			$sql = mainModelo::conexion() ->prepare("
				SELECT id_u, u_name, foto FROM `user` WHERE u_status = 1 AND id_u != $id");
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