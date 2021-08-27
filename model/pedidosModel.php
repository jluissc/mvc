<?php 
	
	require_once 'mainModel.php'; 
	
	class pedidosModel extends mainModel
	{
		
		protected static function guardarPedido_M($datos){
			$sql=mainModel::conexion()->prepare("INSERT INTO pedido(ped_codigo, ped_total, ped_fecha, ped_estado, ped_id_cli ) 
								VALUES(:codigo,:total,now(),:estado,:user)");
			$sql->bindParam(":codigo",$datos['codigo']);
			$sql->bindParam(":total",$datos['total']);
			$sql->bindParam(":estado",$datos['estado']);
			$sql->bindParam(":user",$datos['user']);
			$sql->execute();
			if($sql -> rowCount() == 1){
				exit(json_encode('b'));
				// return 'b';
			}else{
				exit(json_encode('m'));
				// return 'm';
			}
			// return $sql;
		}
		/*  */
		protected static function listaPedidos_M($user){
			$sql=mainModel::conexion()->prepare("SELECT * FROM pedido WHERE ped_id_cli= $user");
			$sql->execute();
			if($sql -> rowCount() > 0){
				$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
				exit(json_encode($datos));
				// return 'b';
			}else{
				exit(json_encode('no'));
			}
		}
		protected static function listaDetPedido_M($user){
			$sql=mainModel::conexion()->prepare("SELECT * FROM `pedido` p
			INNER JOIN det_pedido dp
			ON dp.detped_id_ped = p.id_ped
			INNER JOIN producto pr
			ON pr.id_prod =dp.detped_id_prod WHERE p.id_ped = $user");
			$sql->execute();
			if($sql -> rowCount() > 0){
				$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
				exit(json_encode($datos));
				// return 'b';
			}else{
				exit(json_encode('no')); 
			}
		}
		protected static function listaProdMas_M(){
			$sql=mainModel::conexion()->prepare("SELECT DISTINCT(p.id_prod), p.prod_nombre,fp.foto_url,p.prod_precio,
				p.descuent,p.fecha_des, p.prod_espec, c.cat_nombre  FROM `det_pedido` dp
				INNER JOIN producto p
				ON p.id_prod = dp.detped_id_prod
				INNER JOIN fotos_prod fp
				ON p.id_prod = fp.fotp_id_prod
				INNER JOIN categoria c
				ON p.prod_id_cat = c.id_cat
				");
			$sql->execute();
			if($sql -> rowCount() > 0){
				$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
				exit(json_encode($datos));
				// return 'b';
			}else{
				exit(json_encode('no'));
			}
		}
		protected static function guardarDetalles_M($datos){
			$sql = mainModel::conexion()->prepare("
				INSERT INTO det_pedido(detped_cantidad,detped_color,detped_talla,precio, detped_id_prod, detped_id_ped,usuario_id_usu ) 
				VALUES(:cant,:color,:talla,:precio,:id_prod,:id_ped,:tienda)");
			$sql->bindParam(":cant",$datos['cant']);
			$sql->bindParam(":color",$datos['color']);
			$sql->bindParam(":talla",$datos['talla']);
			$sql->bindParam(":precio",$datos['precio']);
			$sql->bindParam(":id_prod",$datos['id_prod']);
			$sql->bindParam(":id_ped",$datos['id_ped']);
			$sql->bindParam(":tienda",$datos['tienda']);
			// $sql->bindParam(":id_tiend",$datos['id_tiend']);
			$sql->execute();
			if($sql -> rowCount() == 1){
				exit(json_encode('bb'));
				// return 'b';
			}else{
				exit(json_encode('m'));
				// return 'm';
			}
			// return $sql;
			exit(json_encode('aa'));
		}

		protected function idPedido_M($codigo){
			$sql = mainModel::conexion()->prepare("SELECT id_ped FROM pedido WHERE ped_codigo= :codigo");
			$sql->bindParam(":codigo",$codigo);
			$sql->execute();
			if($sql -> rowCount() == 1){
				return $sql -> fetch(PDO::FETCH_OBJ);
			}else{
				return 'm';
			}
		}
		protected function idTienda_M($codigo){
			$sql = mainModel::conexion()->prepare("SELECT prod_id_usu FROM producto WHERE id_prod= :codigo");
			$sql->bindParam(":codigo",$codigo);
			$sql->execute();
			if($sql -> rowCount() == 1){
				return $sql -> fetch(PDO::FETCH_OBJ);
			}else{
				return 'm';
			}
		}
		
	}  