<?php 

	$peticionAjax = true;

	require_once '../config/app.php';

	if (isset($_POST['cliente_dni_reg'])) {
		require_once '../controladores/clienteControlador.php';
		$inst = new clienteControlador();
		if (isset($_POST['cliente_dni_reg']) && isset($_POST['cliente_nombre_reg'])) {
			echo $inst -> agregar_cliente_C();
		}

		// if (isset($_POST['usuario_id_del'])) {
		// 	echo $inst -> eliminar_usuario_C();
		// }

		// if (isset($_POST['usuario_id_up'])) {
		// 	echo $inst -> actualizar_usuario_C();
		// }

	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}	
	 