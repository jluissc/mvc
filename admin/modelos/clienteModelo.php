<?php 
	
	require_once 'mainModelo.php';
	class clienteModelo extends mainModelo {
		protected static function agregar_cliente_M($datos) {
			$sql=mainModelo::conexion()->prepare("INSERT INTO customer(c_name, c_last,c_code, c_status, c_celphoe,c_adress, c_b_id) VALUES(:code,:name,:last,:status,:celphone,:adress,1)");
			$sql->bindParam(":code",$datos['code']);
			$sql->bindParam(":name",$datos['name']);
			$sql->bindParam(":last",$datos['last']);
			$sql->bindParam(":status",$datos['status']);
			$sql->bindParam(":celphone",$datos['celphone']);
			// $sql->bindParam(":Email",$datos['Email']);
			$sql->bindParam(":adress",$datos['adress']);
			// $sql->bindParam(":Clave",$datos['Clave']);
			// $sql->bindParam(":Estado",$datos['Estado']);
			// $sql->bindParam(":Privilegio",$datos['Privilegio']);
			$sql->execute();
			return $sql;
		}
	}
	 