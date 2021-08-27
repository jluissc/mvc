 <?php 
	
	require_once 'mainModelo.php';
	class bussinesModelo extends mainModelo {

		protected static function showBusinnes_M() {
			$idTienda = $_SESSION['privilegio_bot'];
			$sql = mainModelo::conexion() -> 
			prepare("
				SELECT `neg_nombre`, `neg_rubro`, `neg_descripcion`, 
					`neg_dirección`, `neg_telefono`, `neg_messeger` FROM negocio where id_neg = $idTienda" );
			$sql -> execute();
			$datos = $sql->fetch(PDO::FETCH_OBJ);
			return $datos;
			
		}

	} 