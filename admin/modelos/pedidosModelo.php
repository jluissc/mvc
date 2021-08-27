<?php 
	
	require_once 'mainModelo.php';
	class pedidosModelo extends mainModelo {

        /* SELECT * FROM det_pedido dp
        INNER JOIN pedido p
        ON dp.detped_id_ped = p.id_ped
        INNER JOIN cliente c
        ON c.id_cli = p.ped_id_cli
        
        INNER JOIN producto pr
        ON pr.id_prod = dp.detped_id_prod
       WHERE dp.usuario_id_usu = :tienda */
		protected function listaPedidos_m($tiendaID){
            $sql = mainModelo::conexion() -> prepare("
                SELECT * FROM det_pedido dp

                INNER JOIN pedido p
                ON dp.detped_id_ped = p.id_ped

                INNER JOIN cliente c
                ON c.id_cli = p.ped_id_cli
                
                WHERE dp.usuario_id_usu = :tienda

                GROUP BY p.id_ped
                ORDER BY dp.id_detped DESC
            ");
            $sql -> bindParam(":tienda", $tiendaID);
            $sql -> execute();
            $listaPedidos = $sql->fetchAll(PDO::FETCH_OBJ);
            $sql = null;
            return $listaPedidos;
        }

        protected function verPedido_m($idPedido){
            $sql = mainModelo::conexion() -> prepare("
                SELECT * FROM `det_pedido` as dp
                
                INNER JOIN producto p
                ON p.id_prod = dp.detped_id_prod

                WHERE detped_id_ped = :idPedido
            ");
            $sql -> bindParam(":idPedido", $idPedido);
            $sql -> execute();
            $listaPedidos = $sql->fetchAll(PDO::FETCH_OBJ);
            $sql = null;
            exit(json_encode($listaPedidos));
            // return $listaPedidos;
        }
        protected function estadoPedido_m($idDetPedido,$estado){
            $sql = mainModelo::conexion() -> prepare("
                UPDATE `det_pedido` SET estado = :estado
                WHERE id_detped = :idPedido
            ");
            $sql -> bindParam(":idPedido", $idDetPedido);
            $sql -> bindParam(":estado", $estado);
            $sql -> execute();            
            return $sql;
            $sql = null;
        }
        protected function showPedidoClie_m($idcliente){
            $sql = mainModelo::conexion() -> prepare("
                SELECT cli_celular,cli_direccion,cli_user FROM cliente WHERE id_cli = :idcliente and cli_estado = 1
            ");
            $sql -> bindParam(":idcliente", $idcliente);
            $sql -> execute();
            $user = $sql->fetch(PDO::FETCH_OBJ);
            $sql = null;
            exit(json_encode($user)); 
        }

	}   