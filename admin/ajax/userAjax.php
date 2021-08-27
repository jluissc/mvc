<?php 

	$peticionAjax = true;

	require_once '../config/app.php';

	if (isset($_POST['idDato']) || isset($_POST['usuario_id_del']) || isset($_POST['id_user'])) {
		require_once '../controladores/usuarioControlador.php';
		$inst = new usuarioControlador();
		if (isset($_POST['usuario_dni_reg']) && isset($_POST['usuario_nombre_reg'])) {
			echo $inst -> agregar_usuario_C();
		}

		if (isset($_POST['usuario_id_del'])) {
			echo $inst -> eliminar_usuario_C();
		}

		if (isset($_POST['idDato'])) {
			echo $inst -> mostrar_unico_user_C();		
		}

		if (isset($_POST['id_user'])) {
			echo $inst -> update_user_C();	
		}

	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}	
	 