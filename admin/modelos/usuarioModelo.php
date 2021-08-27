<?php 
	 
	require_once 'mainModelo.php';
	class usuarioModelo extends mainModelo
	{

		protected static function listar_user_M($id){
			$sql = mainModelo::conexion() -> prepare("SELECT id_u, u_name, u_last, rol_id_rol FROM user WHERE id_u != $id");
			$sql -> execute();
			$listCat = $sql->fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $listCat;
		}

		protected static function agregar_usuario_M($datos){
			$sql=mainModelo::conexion()->prepare("INSERT INTO user(u_code,u_name,u_last,u_celphone,u_adress,u_user,u_pass,u_status,u_r_id,u_b_id) VALUES(:DNI,:Nombre,:Apellido,:Telefono,:Direccion,:Usuario,:Clave,:Estado,:Privilegio,1)");
			$sql->bindParam(":DNI",$datos['DNI']);
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Apellido",$datos['Apellido']);
			$sql->bindParam(":Telefono",$datos['Telefono']);
			$sql->bindParam(":Direccion",$datos['Direccion']);
			// $sql->bindParam(":Email",$datos['Email']);
			$sql->bindParam(":Usuario",$datos['Usuario']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Estado",$datos['Estado']);
			$sql->bindParam(":Privilegio",$datos['Privilegio']);
			$sql->execute();
			return $sql;
		}
 
		protected static function eliminar_usuario_M($id){
			$sql = mainModelo::conexion() -> prepare("UPDATE user SET u_status = 0 WHERE u_id = :id");
			$sql -> bindParam(":id", $id);
			$sql -> execute();
			return $sql;
		}

		protected static function datos_usuario_M($tipo, $id){

			if ($tipo == "Unico") {
				$sql = mainModelo::conexion() -> prepare("SELECT * FROM user WHERE u_id = :id");
				$sql -> bindParam(":id", $id);

			} elseif($tipo == "Conteo") {
				$sql = mainModelo::conexion() -> prepare("SELECT u_id FROM user WHERE u_id != '1' ");
			}
			$sql -> execute();

			return $sql;
			
		} 

		protected static function update_user_M($datos){
			$sql = mainModelo::conexion() -> prepare("UPDATE user SET u_name = :Nombre, u_last = :Apellido,  u_user = :Usuario, u_pass = :Clave, u_status = :Estado , rol_id_rol =:privi WHERE id_u = :id");
			$sql -> bindParam(":Nombre", $datos['name']);
			$sql -> bindParam(":Apellido", $datos['last']);
			$sql -> bindParam(":Usuario", $datos['user']);
			$sql -> bindParam(":Clave", $datos['pass']);
			$sql -> bindParam(":Estado", $datos['status']);
			$sql -> bindParam(":id", $datos['id']);
			$sql -> bindParam(":privi", $datos['privi']);
			$sql -> execute();
			return $sql;
			
			// falla al actualizar el estato del usuario ***********---OJO---*************
		}


		protected static function mostrar_unico_user_M($id) {
			session_start(['name' => 'bot']);
			$sql = mainModelo::conexion() -> prepare("SELECT u_name, u_last, id_u, u_user, u_pass, u_status, foto, rol_id_rol FROM user WHERE id_u = :id");
			$sql -> bindParam(":id", $id);
			$sql -> execute();
			$listCat = $sql->fetch(PDO::FETCH_OBJ);
			$listCat -> tipo = 'usuario';
			$listCat -> privilegio = $_SESSION['privilegio_bot'];
			$sql = null;
			exit(json_encode($listCat));
		}
	} 