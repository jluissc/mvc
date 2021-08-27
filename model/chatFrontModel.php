<?php 
	
	require_once 'mainModel.php'; 
	
	class chatFrontModelo extends mainModel
	{

		//Chat front_cliente
		protected static function m_chatSave($datos){
            $sql=mainModel::conexion()->prepare("INSERT INTO chats_cli_tiend(chct_mensaje,chct_envio,chct_estado,chct_fecha, chct_id_cliente , chct_id_usuario,chct_id_prod) 
			VALUES(:mensaje, :envio, :estado,:fecha_hora,:cliente, :usuario ,:chat_id_prod)
			");
			$sql->bindParam(":mensaje"		,	$datos['mensaje']);
            $sql->bindParam(":envio"		,	$datos['envio']);
			$sql->bindParam(":estado"		,	$datos['estado']);
			$sql->bindParam(":fecha_hora"	,	$datos['fecha_hora']);
            $sql->bindParam(":cliente"		,	$datos['cliente']);
			$sql->bindParam(":usuario"		,	$datos['usuario']);
			$sql->bindParam(":chat_id_prod"	,	$datos['chat_id_prod']);
			$sql->execute();
			return $sql;
			$sql = null;		
		}
	

		//Chat front_cliente
		protected static function leer_chat($chat_id_prod){
			$sql = mainModel::conexion()->prepare("	SELECT
					chats_cli_tiend.chct_mensaje,
					chats_cli_tiend.chct_fecha,
					chats_cli_tiend.chct_id_prod,
					chats_cli_tiend.chct_envio,
					cliente.cli_nombre,
					producto.id_prod,
					usuario.usu_nombre
				FROM chats_cli_tiend
					INNER JOIN cliente ON cliente.id_cli = chats_cli_tiend.chct_id_cliente
					INNER JOIN producto ON producto.id_prod = chats_cli_tiend.chct_id_prod
					INNER JOIN usuario ON usuario.id_usu = chats_cli_tiend.chct_id_usuario
				WHERE `chct_id_prod` = $chat_id_prod AND `id_prod` = $chat_id_prod 
				ORDER BY chats_cli_tiend.chct_fecha DESC

			");
	

				$sql -> execute();
				$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
				$sql = null;

				//return $datos;	
				
				exit(json_encode($datos));	
		}

		//Inicio de sesion front
		protected static function iniciar_sesion_F($datos){
			
		
			$sql = mainModel::conexion() -> prepare("SELECT * FROM cliente WHERE cli_user = :user AND cli_pass = :pass ");
			$sql->bindParam(":user",$datos['user']);
			$sql->bindParam(":pass",$datos['pass']);
			$sql -> execute();
			return $sql;
			
		}

		//Para insertar comentarios en el chat
		protected static function obtener_id_login($datos){	
			$sql = mainModel::conexion() -> prepare("SELECT id_cli FROM cliente WHERE cli_user = :user AND cli_pass = :pass ");
			$sql->bindParam(":user",$datos['user']);
			$sql->bindParam(":pass",$datos['pass']);
			
			$sql -> execute();
			$datos = $sql -> fetch(PDO::FETCH_ASSOC);
			$sql = null;

			return $datos;
			
				
		}	

		//Para insertar comentarios en el chat
		protected static function guarda_facebook_model($datos){	
			$sql = mainModel::conexion() -> prepare("INSERT INTO cliente(id_cli,cli_nombre) VALUES (:id_cli,:cli_nombre)");
			$sql->bindParam(":id_cli",$datos['id_face']);
			$sql->bindParam(":cli_nombre",$datos['nombre_face']);
			
			$sql->execute();
			return $sql;
			$sql = null;
			
		}
			
		//Guardar cliente sin facebook
		protected static function m_guardar_cliente($datos){
			

				$sql=mainModel::conexion()->prepare("INSERT INTO cliente(cli_nombre, cli_apellido,cli_user,cli_pass, cli_estado) 
				VALUES(:cli_nombre, :cli_apellido, :cli_user,:cli_pass,:cli_estado)");
				
					$sql->bindParam(":cli_nombre"	,	$datos['re_nom']);
					$sql->bindParam(":cli_apellido"	,	$datos['re_ape']);
					$sql->bindParam(":cli_user"		,	$datos['re_ema']);
					$sql->bindParam(":cli_pass"		,	$datos['re_contra']);
					$sql->bindParam(":cli_estado"	,	$datos['re_estado']);
					//$sql->bindParam(":cli_fecha"	,	$datos['re_fecha_hora']);
					$sql->execute();
					return $sql;
					$sql = null;
					
					echo $sql;
		
		}

		

	}  
