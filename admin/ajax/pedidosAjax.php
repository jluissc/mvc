<?php 
	$peticionAjax = true;
	require_once '../config/app.php';

	if (isset($_POST['idPedido']) || isset($_POST['estado']) || isset($_POST['showClP'])) {
		require_once '../controladores/pedidosControlador.php';
		$inst = new pedidosControlador();		

		if (isset($_POST['idPedido'])) {
			$inst -> verPedido_c();
		}
		if (isset($_POST['estado'])) {
			$inst -> estadoPedido();
		}

		if (isset($_POST['showClP'])) {
			$inst -> showPedidoClie();
		}

	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}	
	 