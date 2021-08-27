<?php  
	
	if ($peticionAjax) {
		require_once '../modelos/commentsModelo.php';
	}else{
		require_once './modelos/commentsModelo.php';
	}

	class commentsControlador extends commentsModelo	{
		
		// comp_comm	comp_fecha	prod_id_prod	cust_id_cust	comp_status	id_cust	cust_name	cust_last	cust_email	cust_celphone	cust_status	cust_fecha	bus_id_bus	dist_id_dist	id_prod	prod_name	

		public function c_comentariosProductos(){
			$idUsuario = $_SESSION['id_bot'];
			$datos = commentsModelo::m_comentariosProductos($idUsuario);
			$tr = '';
			foreach ($datos as $key => $commp) {
				$estado = $commp->comp_estado == 1 ? 'checked' : '';
				$key+=1;
				$tr .= '<tr >
	                <td>'.$key.'</td>
	                <td>'.$commp->cli_nombre.' '.$commp->cli_apellido.'</td>
	                <td>'.$commp->prod_nombre.'</td>
	                <td>'.$commp->comp_comm.'</td>
	                <td>
	                	<div class="custom-control custom-switch">
				            <input type="checkbox" '.$estado.'   class="custom-control-input" id="'.$key.'" name="kokkok" onchange="cambioEstadoComment(this.checked,'.$commp->id_comp.')">
				            <label class="custom-control-label" for="'.$key.'">  </label>
				        </div>
		            </td>
	               
	            </tr>';
  
			}
			return $tr;
		}
		

		public function update_comments_C(){
			// $status = isset($_POST['producto_status_edt']) ? 1 : 0;

			$datos = [
				"status" => $_POST['status'],
				"id" => $_POST['id']

			];

			$agregarC = commentsModelo::update_comments_M($datos);

			// if($agregarC -> rowCount() == 1){
			// 	$alerta=[
			// 		"Alerta"=>"recargar",
			// 		"Titulo"=>"Dato Editado",
			// 		"Texto"=>"La categoria fue editado",
			// 		"Tipo"=>"success"
			// 	];
			// 	echo json_encode($alerta);
			// 	exit();
			// }else{
			// 	$alerta=[
			// 		"Alerta"=>"simple",
			// 		"Titulo"=>"Ocurrió un problemsa",
			// 		"Texto"=>"Comuniquese con su proveedor",
			// 		"Tipo"=>"error"
			// 	];
			// 	echo json_encode($alerta);
			// 	exit();
			// }
		} 

		

	} 