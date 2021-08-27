<?php 

	$peticionAjax = true;

	// require_once '../config/app.php';

	if (isset($_POST['total']) || isset($_POST['id_prod']) || isset($_POST['lista']) || isset($_POST['id_ped']) || isset($_POST['listaProd']) ) {
		
		require_once '../controller/pedidosController.php';
		$inst = new pedidosController();
 
		if (isset($_POST['total'])) {
			$inst -> guardarPedido();
		}

		if (isset($_POST['id_prod'])) {
			$inst -> guardarDetalles();
			// echo 'aqui';
		}

		if (isset($_POST['lista'])) {
			$inst -> listaPedidos_C();
			// echo 'aqui';
		}
		if (isset($_POST['id_ped'])) {
			$inst -> listaDetPedido_C();
			// echo 'aqui';
			// exit(json_encode($_POST['id_ped']));
		}
		if (isset($_POST['listaProd'])) {
			$inst -> listaProdMas_C();
			// echo 'aqui';
			// exit(json_encode($_POST['listaProd']));
		}


		
 

	} 

