 <?php 
	
	require_once 'mainModelo.php';
	class productsModelo extends mainModelo {

		protected function guardarEspacio($Id){
			$sql = mainModelo::conexion() -> 
				prepare("INSERT INTO det_producto (det_prod_id_prod) VALUES (:id) ");
			$sql -> bindParam(":id", $Id);
			$sql->execute();
			if($sql -> rowCount() == 1){
				$sql2 = mainModelo::conexion() -> 
					prepare("INSERT INTO fotos_prod (fotp_id_prod) VALUES (:id)");
				$sql2 -> bindParam(":id", $Id);
				$sql2->execute();

				if($sql2 -> rowCount() == 1){
					return 2; /* 2 bien */
				}else{
					return 1;/* 1 para foto_producto */
				}
			}else{
				return 0;/* 0 para detalle_producto */
			}


		}

		protected static function agregar_det_products_M($datos) {
			$pdo = mainModelo::conexion();
			$sql=$pdo->prepare("INSERT INTO det_producto(det_prod_peso, det_prod_altura, det_prod_ancho, det_prod_largo, det_prod_tallas, det_prod_color, det_prod_id_prod) VALUES(:pes, :alt, :anch, :larg, :tall, :col, :id_prod)");
			$sql->bindParam(":pes",$datos['pes']);
			$sql->bindParam(":alt",$datos['alt']);
			$sql->bindParam(":anch",$datos['anch']);
			$sql->bindParam(":larg",$datos['larg']);
			$sql->bindParam(":tall",$datos['tall']);
			$sql->bindParam(":col",$datos['col']);
			$sql->bindParam(":id_prod",$datos['id_prod']);
			$sql->execute();
			return $sql;
			$pdo = null;
		} 

		protected static function agregar_products_M($datos) {
			session_start(['name' => 'bot']);
			$tienda =  $_SESSION['id_bot'];
			$pdo = mainModelo::conexion();
			$sql= $pdo->prepare("INSERT INTO producto(prod_nombre, prod_estado, prod_precio, prod_stock,
				prod_elimino, prod_id_cat, prod_id_usu,prod_espec,marca,modelo,descuent,fecha_des,tags) 
				VALUES(:name, :status, :price, :stock,:elimino, :cat, :tienda, :especif,:marca ,:modelo ,:descuent ,:fecha ,:tags )");
			$sql->bindParam(":name",$datos['name']);
			$sql->bindParam(":status",$datos['status']);
			$sql->bindParam(":price",$datos['price']);
			$sql->bindParam(":stock",$datos['stock']);
			$sql->bindParam(":elimino",$datos['elimino']);
			$sql->bindParam(":especif",$datos['especif']);
			$sql->bindParam(":cat",$datos['cat']);
			$sql->bindParam(":marca",$datos['marca']);
			$sql->bindParam(":modelo",$datos['modelo']);
			$sql->bindParam(":descuent",$datos['descuent']);
			$sql->bindParam(":fecha",$datos['fecha']);
			$sql->bindParam(":tags",$datos['tags']);
			$sql->bindParam(":tienda",$tienda);
			$sql->execute();
			if($sql -> rowCount() == 1){
				$lastInsertId = $pdo->lastInsertId();
				return $lastInsertId;
			}else{
				return false;
			}
			$pdo = null;
		} 
		

		protected static function lista_products_M() {
			$tienda =  $_SESSION['id_bot'];
			$sql = mainModelo::conexion() -> 
			prepare("
				SELECT p.id_prod, p.prod_nombre, p.prod_precio,p.prod_stock,p.prod_estado  FROM producto as p
				WHERE p.prod_elimino = 0 AND p.prod_id_usu = :tienda
			");		
			$sql -> bindParam(":tienda", $tienda);
			$sql -> execute();
			$listCat = $sql->fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $listCat;
		}

		protected static function unic_products_M($id,$tipo) {
			if($tipo == 'fotos'){
				$sql = mainModelo::conexion() -> prepare("SELECT * FROM fotos_prod WHERE fotp_id_prod = :id");
			}
			elseif ($tipo == 'detalles'){
				$sql = mainModelo::conexion() -> prepare("SELECT * FROM det_producto WHERE det_prod_id_prod = :id");
			}
			else{

				$sql = mainModelo::conexion() -> prepare("SELECT * FROM producto WHERE id_prod = :id");
			}
			$sql -> bindParam(":id", $id);
			$sql -> execute();
			$listProd = $sql->fetch(PDO::FETCH_OBJ);
			$listProd -> tipo = $tipo;
			$sql = null;
			exit(json_encode($listProd));
		}

		protected static function lista_categorys_M() {
			$sql = mainModelo::conexion() -> prepare("SELECT * FROM categoria ");		
			$sql -> execute();
			$listProd = $sql->fetchAll(PDO::FETCH_OBJ);
			// $listProd -> tipo = 'productsLista';
			$sql = null;
			exit(json_encode($listProd)); 
		}

		protected static function update_products_M($datos) {
			$sql=mainModelo::conexion()->prepare("UPDATE producto SET prod_nombre = :name, prod_estado =:status, 
			prod_precio =:price, prod_stock =:stock, prod_espec = :especif,marca = :marca,modelo = :modelo,descuent = :descu,fecha_des = :fecdesc,tags = :tags  WHERE id_prod =:id");
			$sql->bindParam(":name",$datos['name']);
			$sql->bindParam(":status",$datos['status']);
			$sql->bindParam(":price",$datos['price']);
			$sql->bindParam(":stock",$datos['stock']);
			$sql->bindParam(":especif",$datos['especif']);
			$sql->bindParam(":marca",$datos['marca']);
			$sql->bindParam(":modelo",$datos['modelo']);
			$sql->bindParam(":descu",$datos['desc']);
			$sql->bindParam(":fecdesc",$datos['fecdesc']);
			$sql->bindParam(":tags",$datos['tags']);
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			return $sql;
			$sql = null;
		}

		protected static function update_detalles_prod_M($datos) {
			$sql=mainModelo::conexion()->prepare("UPDATE `det_producto` SET `det_prod_peso`= :pes_vol,`det_prod_altura`= :alt,`det_prod_ancho`= :anch,`det_prod_largo`= :lar,`det_prod_tallas`= :talla,`det_prod_color`=:color  WHERE `id_det_prod`= :id");
			$sql->bindParam(":pes_vol",$datos['pes_vol']);
			$sql->bindParam(":alt",$datos['alt']);
			$sql->bindParam(":anch",$datos['anch']);
			$sql->bindParam(":lar",$datos['larg']);
			$sql->bindParam(":talla",$datos['talla']);
			$sql->bindParam(":color",$datos['color']);
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			return $sql;
			$sql = null;
		}

		protected static function update_fotos_prod_M($datos) {
			$sql=mainModelo::conexion()->prepare("UPDATE `fotos_prod` SET
			 `foto_url`= :fot_p,
			 `foto_p`= :fotp_u ,
			 `foto_s`= :fotp_d,
			 `foto_t`= :fotp_t 
			WHERE `id_fotp`= :id");
			$sql->bindParam(":fot_p",$datos['fot_port']);
			$sql->bindParam(":fotp_u",$datos['fot_u']);
			$sql->bindParam(":fotp_d",$datos['fot_d']);
			$sql->bindParam(":fotp_t",$datos['fot_t']);
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			return $sql;
			$sql = null;
		}

		protected static function delete_products_M($datos) {
			$sql=mainModelo::conexion()->prepare("UPDATE producto SET prod_elimino = 1  WHERE id_prod =:id");
			$sql->bindParam(":id",$datos['id']);
			$sql->execute();
			return $sql;
			$sql = null;
		}
	}   