<?php 
	if ($peticionAjax) {
		require_once '../model/chatFrontModel.php';
	}else{
		require_once './model/chatFrontModel.php';
	}
	// // encontrar el error de la url *************
	class chatfrontControlador extends chatFrontModelo
	{
		public function c_chatSave(){

            //var_dump($_REQUEST);
          
            $chat_id_prod   = $_POST['chat_id_prod'];
            $mensaje        = $_POST['mensaje_front'];
            $envio          = $_POST['envio'];
            $estado         = $_POST['estado'];
            $fecha_hora     = $_POST['fecha_A_M_D'].' '.$_POST['hora_H_M_S'];
            //$hora_H_M_S     = $_POST['hora_H_M_S'];
            $id_cliente     = $_POST['id_cliente'];
            $id_usuario     = $_POST['id_usuario'];
            
            $datos = [
                "chat_id_prod"  => $chat_id_prod,
                "mensaje"       => $mensaje,
                "envio"         => $envio,
                "estado"        => $estado,
                "fecha_hora"    => $fecha_hora,
                "cliente"       => $id_cliente,
                "usuario"       => $id_usuario
            ];

			$result = chatFrontModelo::m_chatSave($datos);
			if($result -> rowCount() >0){

                return 'bien';
        
            }else{
                return 'mal';
            }
            
            

               //Valores normal
            //    return $mensaje; 
                        // Cuando use json encode
                        //exit(json_encode())
        }
        
        public function listaChats_c(){
            //var_dump($_REQUEST);
            $chat_id_prod   = $_POST['chat_id_prod'];
            //var_dump($chat_id_prod);
            
            $result = chatFrontModelo::leer_chat($chat_id_prod);

            return $result;
        
        } 

        public function iniciar_sesion_C(){
                //echo "Pajarito";


                //Temporal sin tratamientos
                $user = $_POST['nombre_front'];
                $pass = $_POST['contra_front'];

                $datos = [
                    "user" => $user,
                    "pass" => $pass
                ];

                //Llama a su chero modelo
                $instancia = chatFrontModelo::iniciar_sesion_F($datos);
                $id_cli = chatFrontModelo::obtener_id_login($datos);
                
                $contador = $instancia -> rowCount();

                
                 $_SESSION["ultimo_id"] = $id_cli['id_cli'];
           

                if($contador == 1){
                    //echo 'SI DA MASCOTA';
                    $datos = $instancia -> fetch();
                   

                    $a      = $_SESSION["usuario_front"] = $datos['cli_user'];
                    $b      = $_SESSION["contra_front"]  = $datos['cli_pass'];
                    
 

                /*
                    echo '<pre>';
                        print_r($a);
                        echo "<br>";
                        print_r($b);
                    echo '</pre>';
                */                   
					
		
                    
                }else{
					echo '  <script>
						console.log("No tienes permisos BRO");
					        </script>';
				}
              



        }


        public function guarda_facebook($datos){

            $resultado = chatFrontModelo::guarda_facebook_model($datos);
			if($resultado -> rowCount() > 0){

                //return 'bien mira la BD';
                        
                                 
                            
                            $_SESSION["ultimo_id"] = $datos['id_face'];
                            $_SESSION["usuario_front"] = $datos['nombre_face'];
                        
                            
                            //Solo para el ID de facebook
                            $cookie_id = "id_face";
                            $cookie_valor = $datos['id_face'];
                            setcookie($cookie_id, $cookie_valor, time() + (86400 * 30), "/"); // 86400 = 1 day

                            //Solo para el nombre de facebook
                            $cookie_name = "nombre_face";
                            $cookie_value = $datos['nombre_face'];
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                                    
        
            }else{
                // solo para 1 valor return 'mal';

                            $_SESSION["ultimo_id"] = $datos['id_face'];
                            $_SESSION["usuario_front"] = $datos['nombre_face'];

                            //var_dump($_SESSION);
                            $_SESSION["ultimo_id"] = $datos['id_face'];
                            $_SESSION["usuario_front"] = $datos['nombre_face'];

                            //Solo para el ID de facebook
                            $cookie_id = "id_face";
                            $cookie_valor = $datos['id_face'];
                            setcookie($cookie_id, $cookie_valor, time() + (86400 * 30), "/"); // 86400 = 1 day

                            //Solo para el nombre de facebook
                            $cookie_name = "nombre_face";
                            $cookie_value = $datos['nombre_face'];
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                                    
                            
               
            }
            
            echo "Reinicio desde server";
           
        }
        
        public function c_guardar_cliente(){
            
            $datos = [
                "re_nom"   	    => $_POST['re_nom'],
                "re_ape"   	    => $_POST['re_ape'],
                "re_ema"        => $_POST['re_ema'],
                "re_contra"     => $_POST['re_contra'],
                "re_fecha_hora" => $_POST['re_fecha_hora'],
                "re_estado"     => 1
            ];
            
            $resultado = chatFrontModelo::m_guardar_cliente($datos);
            $contador = $resultado -> rowCount();
            echo $contador;
        }
	}  