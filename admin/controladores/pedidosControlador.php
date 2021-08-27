<?php  
	
	if ($peticionAjax) {
		require_once '../modelos/pedidosModelo.php';
	}else{
		require_once './modelos/pedidosModelo.php';
	}

	class pedidosControlador extends pedidosModelo	{
		
		 

        public function listaPedidos_c(){
            $tiendaID = $_SESSION['id_bot'];
            $cards = '<div class="row">';
            $pedidos = pedidosModelo::listaPedidos_m($tiendaID);
            foreach ($pedidos as $pedido) {
                $cards .='
                <div class="card" style="width: 18rem;">
                    <button class="btn btn-warning" onclick="detalCliente('.$pedido->id_cli.')" 
                        data-bs-toggle="modal" data-bs-target="#exampleModal">VER CLIENTE</button>
                    <div class="card-body">
                       
                        <h5 class="card-title">S/. '.$pedido->ped_total.'.00</h5>
                        <p class="card-text">De '.$pedido->cli_nombre.' '.$pedido->cli_apellido.'</p>
                        <button onclick="verLista('.$pedido->id_ped.')" 
                            class="btn btn-success" data-bs-toggle="offcanvas" 
                        data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Ver Pedido</button>
                        
                        
                    </div>
                </div>'; 
            }
            $cards .='</div>';

            return $cards;
        }
		
        public function verPedido_c(){
            $idPedido = $_POST['idPedido'];
            pedidosModelo::verPedido_m($idPedido);
        }

        public function estadoPedido(){
            $idDetPedido = $_POST['estado'];
            $est = 1;
            $estado = pedidosModelo::estadoPedido_m($idDetPedido,$est);
            if ($estado ->rowCount() == 1){
                echo 1;
            } else {
                echo 0;
            }
            
        }
        public function showPedidoClie(){
            $idCliente = $_POST['idC'];
            pedidosModelo::showPedidoClie_m($idCliente);
        }

	}  