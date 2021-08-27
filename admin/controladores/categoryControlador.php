<?php  
	 
	if ($peticionAjax) {
		require_once '../modelos/categoryModelo.php';
	}else{
		require_once './modelos/categoryModelo.php';
	}

	class categoryControlador extends categoryModelo	{
		
		public function agregar_category_C(){
			session_start(['name' => 'bot']);
			$id_u =  $_SESSION['id_bot'];
			$name=mainModelo::limpiar_cadena($_POST['categoria_name_reg']);
			$status = isset($_POST['rr']) ? 1 : 0;
			// $status=mainModelo::limpiar_cadena($_POST['categoria_status_reg']);

			if($name == null || $name == ''){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Dato Vacio",
					"Texto"=>"Completa los datos",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			} 

			if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}",$name)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			$datos = [
				"nombre" => $name,
				"estado" => $status,
				"elimino" => 0,
				"id_usu" => $id_u
			];
			$agregarC = categoryModelo::agregar_category_M($datos);

			if($agregarC -> rowCount() == 1){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Datos Guardados",
					"Texto"=>"La categoria fue guardado",
					"Tipo"=>"success"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un problemsa",
					"Texto"=>"No se pudo guardar la cat, intentalo de nuevo",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		
		}

		public function lista_category_C(){
			$datos = categoryModelo::lista_category_M();
			$card = '<div class="col-md-2">
	            <div class="card text-center">
	                <div class="card-body bg-primary">
	                    <a href="#" class="btn btn-success" data-toggle="modal"data-target="#newCategory"> Nueva Categoria	</a>
	                </div>
	            </div>
	        </div>
	        ';
	                    // <p class="card-text">..</p> antes del a
			foreach ($datos as $ki => $cat) {
			$status = $cat ->cat_estado == 0 ? 'bg-danger' : '';
			$card .= 
					'<div class="col-md-2 ">
                        <div class="card text-center">
                            <div class="card-body '.$status.'">
                                <h4 class="card-title">'.$cat->cat_nombre.'</h4>
                                
                                <a href="" onclick="traerDatos('.$cat->id_cat.')" class="btn btn-success" data-toggle="modal" data-target="#editCategory"><i class="fas fa-edit"></i></a>

                                 <a href="#" onclick="eliminar('.$cat->id_cat.',0)" class="btn btn-info text-right "><i class="far fa-trash-alt"></i></a>

                            </div>
                        </div>
                    </div>';
			}
			// falta poner boton de eliminar directo 
			return $card;
		}

		public function unic_category_C() {
			
			$id = categoryModelo::unic_category_M($_POST['idDato']);
		}

		public function update_category_C(){
			$name=mainModelo::limpiar_cadena($_POST['categoria_name_edit']);
			$status = isset($_POST['rre']) ? 1 : 0;
			$id=mainModelo::limpiar_cadena($_POST['id_cat']);

			if($name == null || $name == ''){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Dato Vacio",
					"Texto"=>"Completa los datos",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

			if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}",$name)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El nombre no coincide con el formato solicitado",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}


			$datos = [
				"name" => $name,
				"status" => $status,
				"id" => $id
			];

			$agregarC = categoryModelo::update_category_M($datos);

			if($agregarC -> rowCount() == 1){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Dato Editado",
					"Texto"=>"La categoria fue editado",
					"Tipo"=>"success"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un problemsa",
					"Texto"=>"Comuniquese con su proveedor",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}

		public function delete_category_C(){
			$datos = [
				"id" => $_POST['id_del']
			];

			$agregarC = categoryModelo::delete_category_M($datos);

			if($agregarC -> rowCount() == 1){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Dato Eliminado",
					"Texto"=>"La categoria fue eliminado",
					"Tipo"=>"success"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un problema",
					"Texto"=>"Comuniquese con su proveedor",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}

	}