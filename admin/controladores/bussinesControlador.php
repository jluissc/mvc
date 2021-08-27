<?php  
	
	if ($peticionAjax) {
		require_once '../modelos/bussinesModelo.php';
	}else{
		require_once './modelos/bussinesModelo.php';
	}

	class businessControlador extends bussinesModelo {

		public function showBusinnes_C() {
			return bussinesModelo::showBusinnes_M();
		}
	} 