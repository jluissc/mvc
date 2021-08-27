<?php 
	
	require_once 'mainModel.php'; 
	
	class productosModelo extends mainModel
	{
		protected static function guardarIntereses($inter, $idAl){
			$pdo = mainModel::conexion();
			$sql=$pdo->prepare("INSERT INTO  `interests`(`user_id`, `category_id`) VALUES(:idAl, :inter)");
			$sql->bindParam(":inter",$inter);
			$sql->bindParam(":idAl",$idAl);
			$sql->execute();
			if($sql -> rowCount() == 1){
				return true;
			}else{
				return false;
			}
			$sql = null;
		}

		protected static function mostrar_interes_M(){
			$sql = mainModel::conexion()->prepare("SELECT idalum , intereses FROM `user_web` LIMIT 20000,5000");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;
		}
		protected static function listaBanner_M(){
			$sql = mainModel::conexion()->prepare("SELECT p.prod_nombre,p.prod_precio,f.foto_url, c.cat_nombre FROM `producto` p
			INNER JOIN fotos_prod f 
			ON p.id_prod = f.fotp_id_prod
			INNER JOIN categoria c
			ON c.id_cat= p.prod_id_cat
			WHERE prod_premiun = 1");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;	
		}

		protected static function listaProductos($id){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p INNER JOIN `categoria` AS c 
				ON p.prod_id_cat = c.id_cat WHERE cat_nombre LIKE '%$id%' OR prod_nombre LIKE '%$id%'");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;	
		}

		protected static function fotoProducto($id){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `fotos_prod` WHERE fotp_id_prod = $id");
			$sql -> execute();
			$datos = $sql -> fetch(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;	
		}

		protected static function buscarProducto_M($text){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` WHERE prod_nombre LIKE '%$text%' AND prod_estado=1");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			// return $datos;	
			exit(json_encode($datos));
		}

		// **************



		protected static function listar_productos_M(){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p
				INNER JOIN categoria AS c
				ON p.prod_id_cat = c.id_cat
				WHERE p.prod_estado = 1 ");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;			
		}

		protected static function all_productos_M($tipo){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p
				INNER JOIN categoria AS c
				ON p.prod_id_cat = c.id_cat
                
                INNER JOIN fotos_prod ft
                ON ft.fotp_id_prod = p.id_prod
				WHERE p.prod_estado = 1  AND (p.prod_nombre LIKE '%$tipo%' OR c.cat_nombre LIKE '%$tipo%' )");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;			
		}

		protected static function typeCategoria_m($idCategoria){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p
				INNER JOIN categoria AS c
				ON p.prod_id_cat = c.id_cat
                
                INNER JOIN fotos_prod ft
                ON ft.fotp_id_prod = p.id_prod
				WHERE p.prod_estado = 1 AND c.id_cat = $idCategoria");
			$sql -> execute();
			$datos = $sql -> fetchAll(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;			
		}

		protected static function showProductoId_M($id_prod){
			$sql = mainModel::conexion()->prepare("SELECT * FROM `producto` AS p
				INNER JOIN categoria AS c
				ON p.prod_id_cat = c.id_cat
                
                INNER JOIN fotos_prod ft
                ON ft.fotp_id_prod = p.id_prod

				INNER JOIN det_producto dp
                ON dp.det_prod_id_prod = p.id_prod

				WHERE p.prod_estado = 1 AND p.id_prod = $id_prod" );
			$sql -> execute();
			$datos = $sql -> fetch(PDO::FETCH_OBJ);
			$sql = null;
			
			$empresa = productosModelo::showDatosEmpresa($id_prod);
			$final = [
				"producto" => $datos,
				"empresa" => $empresa,
			];
			exit(json_encode($final));		
		}

		protected static function showDatosEmpresa($id_prod){
			$sql = mainModel::conexion()->prepare("SELECT n.neg_telefono, n.neg_messeger FROM `producto` AS p
			INNER JOIN usuario AS u
			ON u.id_usu = p.prod_id_usu
			
			INNER JOIN negocio AS n
			ON n.id_neg = u.usu_id_neg
			WHERE p.prod_estado = 1 AND p.id_prod =  $id_prod" );
			$sql -> execute();
			$datos = $sql -> fetch(PDO::FETCH_OBJ);
			$sql = null;
			return $datos;	
		}
	}  