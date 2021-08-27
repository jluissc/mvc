<?php 
$peticionAjax = false;
    if ($peticionAjax) { 
        require_once '../model/homeModel.php';
    }else{ 
        require_once './model/homeModel.php';
    }
    // encontrar el error de la url *************
    class homeController extends homeModel
    {
        public function list_Home_Productos_C($id_cat){
            // $datos = homeModel::list_Home_Productos_M();
            // var_dump($datos);
            $div = '';
            $datos = homeModel::list_Home_Productos_M($id_cat);
            
            // var_dump($datos);
            foreach ($datos  as $key => $prod) {
            $div .= '<div class="col-lg-3 col-md-4 col-sm-6 u-s-m-b-30">
                        <div class="product-r u-h-100">
                            <div class="product-r__container">
                                <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.SERVERURL.'producto-detalle/'.$prod->id_prod.'">
                                    
                                    <img class="aspect__img" src="'.SERVERURL."admin".$prod->foto_url.'" alt=""></a>
                                <div class="product-r__action-wrap">
                                    <ul class="product-r__action-list"> 
                                        <li>
                                            <a data-modal="modal" data-modal-id="#quick-look"><i class="fas fa-search-plus"></i></a></li>
                                        <li>
                                            <a data-modal="modal" data-modal-id="#add-to-cart"><i class="fas fa-plus-circle"></i></a></li>
                                        <li>
                                            <a href="signin.html"><i class="fas fa-heart"></i></a></li>
                                        <li>
                                            <a href="signin.html"><i class="fas fa-envelope"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-r__info-wrap">
                                <span class="product-r__category">
                                    <a href="../2/1">'.$prod->cat_nombre.'</a></span>
                                <div class="product-r__n-p-wrap">
                                    <span class="product-r__name">
                                        <a href="'.SERVERURL.'producto-detalle/'.$prod->id_prod.'">'.$prod->prod_nombre.'</a></span>
                                    <span class="product-r__price">S/. '.$prod->prod_precio.'</span></div>
                                <span class="product-r__description">Descripcion....</span>
                            </div>
                        </div>
                    </div>';
            }
            return $div; 
        }
        
        public function traer_producto_id_C($id){
            $datos = homeModel::traer_producto_id_M($id);
            return $datos; 
        }

        public function traer_coment_prod_C($id){
            $datos = homeModel::traer_coment_prod_M($id);
            $com = '';
            foreach ($datos as $coment) {
                $com .='<div class="review-o u-s-m-b-15">
                            <div class="review-o__info u-s-m-b-8">
                                <span class="review-o__name">'.$coment->usu_nombre.'</span>
                                    <span class="review-o__date">27 Feb 2018 10:57:43</span>
                            </div>
                            <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                <span>(4)</span>
                            </div>
                            <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>';
                return $com;
            }
        }
        
        public function agregar_puntuacion_C(){
            $punto = $_POST['puntuacion'];
            $datos = [
                "punto"=>$punto,
                "clien"=>2,
                "prod"=>14
            ];
            $datos = homeModel::agregar_puntuacion_M($datos);
            // return $datos; 
        }


    }    