<?php 

	$peticionAjax = true;

	require_once '../config/app.php';

	if ( isset($_POST['chatUnico']) || isset($_POST['mensajeEnv']) ) {
		
		require_once '../controladores/chatCUControlador.php';
		$chat = new chatCUControlador();
		

		// traer mensajes Unico
		if (isset($_POST['chatUnico'])) {
			$chat ->unic_chatCU_C(); 
		}

		// guardar Mensaje
		if (isset($_POST['mensajeEnv'])) {
			$chat -> registrarMensaje_chatCU_C();			
		}
		
	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}	 
 