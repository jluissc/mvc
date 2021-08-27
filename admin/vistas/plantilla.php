<!DOCTYPE html> 
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
	<?php include "./vistas/inc/link.php"; ?>
    <style>
        .activeee{
            color: blue;
            font:bold 16px "Trebuchet MS";
        }
        
    </style>
</head>
<body> 
    
	
	<?php 
		$peticionAjax = false;
		require_once "./controladores/vistasControlador.php"; 
		$IV = new vistasControlador();
		$vistas = $IV -> obtener_vistas_C();
		if($vistas == "login" || $vistas == "404"){
			require_once "./vistas/contenidos/".$vistas."-view.php";
		}else{
			session_start(['name' => 'bot']);
			$pagina = explode("/",$_GET['ruta']);
			require_once "./controladores/loginControlador.php"; 
			$inst = new loginControlador();
			if (!isset($_SESSION['token_bot']) || !isset($_SESSION['nombre_bot']) || !isset($_SESSION['privilegio_bot']) || !isset($_SESSION['id_bot']) ) {
				echo $inst -> forzar_cierre_C();
				exit();
			}	 	
	?>
	<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
	<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <!-- LATERAL**************+ -->
        <?php include "./vistas/inc/navLateral.php"; ?>
        
            <!-- volteado -->
        <!-- BARRA NAV**************+ -->
        <?php include "./vistas/inc/navBar.php"; ?>


       
        

        <div class="page-wrapper">
             
           	<!-- princiapl**************+ -->
             <div id="app">
                <div class="container-fluid" >
                    
                    <?php include $vistas; ?>
                </div>
             </div>
            <!-- footer -->
           
            <footer class="footer text-center text-muted">
                PEPSTORE @ 2021 - HUÁNUCO
            </footer>
          
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
	
	<?php 
		include "./vistas/inc/logout.php"; 
		}
       
		include "./vistas/inc/scrip.php"; 
	?>

    <!-- ********************* -->
    <div class="modal fade" id="abcde" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title te" id="myModalLabel">Encuesta de satisfacción</h4>
                    <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
                </div>                
				
				<div class="modal-body" style="background-image: url('./vistas/assets/images/encuesta.jpg');">
					<div class="card text-center">
                        <strong><h3>Por favor ayudame a mejorar, con una pequeña encuesta</h3></strong>
						<div id="estado">
                            
                        </div>
					</div>
				</div>
                
				<div class="modal-footer" id="botones">
					<button type="reset" class="btn btn-light" data-dismiss="modal" onclick="rechazar()">Rechazar</button>
					<button type="submit" class="btn btn-primary" onclick="aceptar()">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdWbAeqSxJDFNV90IN2gHjkA1oJfKbfxNJ4XgDv05ycpmfvFQ/viewform?usp=sf_link" 
                        style="color: white;" target="_bank">Aceptar</a>
                    </button>
				</div>
				
            </div>
        </div>
    </div>
    <!-- ********************* -->

</body>
</html>
