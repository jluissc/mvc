<?php 

	$peticionAjax = true;

	require_once '../config/app.php';

	if (isset($_POST['status']) || isset($_POST['idDato']) || isset($_POST['categoria_name_edit']) || isset($_POST['id_del'])) {
		
		require_once '../controladores/commentsControlador.php';
		$inst = new commentsControlador();

		// registro nueva categoria
		if (isset($_POST['categoria_name_reg'])) {
			echo $inst -> agregar_category_C();
			// $radio = isset($_POST['rr']) ? 1 : 0;
			// // $radio = $_POST['rr'];
			// // if ($radio) {
			// //  	$radio;
			// //  } else{
			// //  	$radio;
			// //  }
			//  echo $radio;
		}

		// traer categoria Unico
		if (isset($_POST['idDato'])) {
			$inst ->unic_category_C(); 
		}

		// editar Categoria
		if (isset($_POST['status'])) {
			echo $inst -> update_comments_C();			
		}

		// eliminar Categoria
		if (isset($_POST['id_del'])) {
			echo $inst -> delete_category_C();			
		}


	} else {
		session_start(['name' => 'bot']);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		exit();
	}	
 