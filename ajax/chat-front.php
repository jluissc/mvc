<?php 

	$peticionAjax = true;

	// require_once '../config/app.php';
	//var_dump($_REQUEST);
	//die();

/////////////////////////////  REGISTRO NORMAL ///////////////////
if (isset($_POST['re_nom']) && isset($_POST['re_contra'])) {
	//echo "Llegaste perron";
	//var_dump($_REQUEST);
	//die();

	require_once '../controller/chat-frontController.php';
	$guarda_cliente = new chatfrontControlador();

	
	echo $guarda_cliente -> c_guardar_cliente();

	 
	
}

/////////////////////////////  LOGIN FACEBOOK ///////////////////
if (isset($_POST['face_id']) || isset($_POST['face_nom'])) {
	//echo "Llegaste perron";
	require_once '../controller/chat-frontController.php';
	$login_face = new chatfrontControlador();

	$id_face	 = $_POST['face_id'];
	$nombre_face = $_POST['face_nom'];

	$datos = [
		"id_face" => $id_face,
		"nombre_face" => $nombre_face
	];
	//var_dump($_POST);
	
	 echo $login_face -> guarda_facebook($datos);
	
}
//////////////////////////// LISTAR DEL CHAT  ////////////////////////////////////////


	if (isset($_POST['id_cliente']) || isset($_POST['cli_user']) || isset($_POST['clave']) ) {
		
		require_once '../controller/chat-frontController.php';
		$inst = new chatfrontControlador();



		$listaChats = new chatfrontControlador();
	 
		

		if (isset($_POST['id_cliente'])) {
			echo $inst -> c_chatSave();
		}

		if (isset($_POST['clave'])) {
			echo $listaChats -> listaChats_c();
		}


		




























        
////////////////////////////////////////////////////////////////////
	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		
		exit();
	}	




