<?php 

	$peticionAjax = true;

	require_once '../config/app.php';

	if (isset($_POST['mensajeEnv']) || isset($_POST['idListaM']) || isset($_POST['categoria_name_edit']) || isset($_POST['category_id_del'])) {
		
		require_once '../controladores/chatUUControlador.php';
		$inst = new chatUUControlador();

		// registro nuevo mensaje
		if (isset($_POST['mensajeEnv'])) {
			// echo $_POST['idRec'];
			$inst ->registrarMensaje_chatUU_C();
		}

		// traer mensajes Unico
		if (isset($_POST['idListaM'])) {
			$inst ->unic_chatUU_C(); 
		}

		// editar Categoria
		if (isset($_POST['categoria_name_edit'])) {
			echo $inst -> update_category_C();			
		}

		// eliminar Categoria
		if (isset($_POST['category_id_del'])) {
			echo $inst -> delete_category_C();			
		}


	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}	
