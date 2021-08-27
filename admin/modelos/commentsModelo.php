 <?php 
	
	require_once 'mainModelo.php';
	class commentsModelo extends mainModelo {

		
		protected static function m_comentariosProductos($idUsuario) {
			$sql = mainModelo::conexion() -> 
			prepare("SELECT * FROM coment_prod cp

			INNER JOIN producto pr
			ON cp.comp_id_prod = pr.id_prod


			INNER JOIN usuario us
			ON pr.prod_id_usu = us.id_usu

			INNER JOIN cliente cl
			ON cp.comp_id_cli = cl.id_cli

			WHERE us.id_usu = $idUsuario");
			$sql -> execute();
			$listCat = $sql->fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $listCat;
		}

		
		protected static function update_comments_M($datos) {
			$sql=mainModelo::conexion()->prepare("UPDATE coment_prod SET comp_estado = :status WHERE id_comp =:id");
			$sql->bindParam(":status",$datos['status']);
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			// exit(json_encode(commentsModelo::lista_comments_M()));
			// return $sql;
			$sql = null;
		}
	}    