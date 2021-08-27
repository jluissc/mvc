<?php 
	
	require_once 'mainModel.php'; 
	
	class homeModel extends mainModel
	{
		
		protected static function list_Home_Productos_M(){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p
				INNER JOIN categoria AS c
				ON p.prod_id_cat = c.id_cat

				INNER JOIN fotos_prod AS fp
				ON fp.fotp_id_prod = p.id_prod

				WHERE p.prod_estado = 1 ");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;			
		}

		protected static function traer_producto_id_M($id){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p
				INNER JOIN categoria AS c
				ON p.prod_id_cat = c.id_cat
				INNER JOIN detped AS dpr
				ON p.id_prod = dpr.detped_id_prod
				INNER JOIN fotos_prod AS fp
				ON p.id_prod = fp.fotp_id_prod
				
				WHERE p.prod_estado = 1 AND p.id_prod = $id ");
			$sql -> execute();
			$datos = $sql -> fetch(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;			
		}

		protected static function traer_coment_prod_M($id){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `coment_prod` AS c INNER JOIN usuario AS u ON c.comp_id_usu = u.id_usu  WHERE comp_id_prod = $id ");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;			
		}

		protected static function agregar_puntuacion_M($datos){
			$sql = mainModel::conexion()->prepare("INSERT INTO `puntprod`(`puntpr_estado`, `puntpr_id_usu`, `puntpr_id_prod`) VALUES (:punto, :clien , :prod) ");
			$sql ->bindParam(":punto", $datos['punto']);
			$sql ->bindParam(":clien", $datos['clien']);
			$sql ->bindParam(":prod", $datos['prod']);

			$sql -> execute();
			// return $sql;			
			$sql = null;
		}


	} 