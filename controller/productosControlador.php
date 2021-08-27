<?php 
	if ($peticionAjax) {
		require_once '../model/productosModelo.php';
	}else{
		require_once './model/productosModelo.php';
	}
	// encontrar el error de la url *************
	class productosControlador extends productosModelo
	{
		
        public function mostrar_intereses(){
            $datos = productosModelo::mostrar_interes_M();
            foreach ($datos as $dato) {
                if($dato->intereses != ''){
                    $intereses = explode('/',$dato->intereses);
                    foreach ($intereses as $interes) {
                        if($interes != ''){
                            if (productosModelo::guardarIntereses($interes,$dato->idalum)) {
                                echo "Good".$dato->idalum;
                            } else {
                                echo "Bad".$dato->idalum;
                            }
                        }
                    }                    
                }
                echo "<br>";
            }
        }

        public function typeCategoria_c($idCategoria){
            $categorias = productosModelo::typeCategoria_m($idCategoria);
            $categorias_lista = '';
            foreach ($categorias as $prod) {
                $categorias_lista .= '<div class="col-lg-3 col-md-4 col-sm-6 u-s-m-b-30">
                        <div class="product-r u-h-100">
                            <div class="product-r__container">
                                <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.SERVERURL.'producto-detalle/'.$prod->id_prod.'">
                                    
                                    <img class="aspect__img" src="'.SERVERURL."admin".$prod->foto_url.'" alt=""></a>
                                <div class="product-r__action-wrap">
                                    <ul class="product-r__action-list"> 
                                        <li>
                                            <a data-modal="modal" data-modal-id="#quick-look" onclick="mostrarDetallesPro()">
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                        </li>
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
            return $categorias_lista;
        }

		public function all_productos_C(){
            
            $div = '';

            $productos = productosModelo::all_productos_M();

            foreach ($productos as $prod) {
                

                $div .= '<div class="col-lg-3 col-md-4 col-sm-6 u-s-m-b-30">
                        <div class="product-r u-h-100">
                            <div class="product-r__container">
                                <a class="aspect aspect--bg-grey aspect--square u-d-block" href="'.SERVERURL.'producto-detalle/'.$prod->id_prod.'">
                                    
                                    <img class="aspect__img" src="'.SERVERURL."admin".$prod->foto_url.'" alt=""></a>
                                <div class="product-r__action-wrap">
                                    <ul class="product-r__action-list"> 
                                        <li>
                                            <a data-modal="modal" data-modal-id="#quick-look" onclick="mostrarDetallesPro()">
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a data-modal="modal" data-modal-id="#add-to-cart" 
                                                onclick="agregarCarro('.$prod->id_prod.')">
                                                <i class="fas fa-plus-circle"></i>
                                                </a>
                                        </li>

                                        <li>
                                            <a href="signin.html"><i class="fas fa-heart"></i></a>
                                            </li>
                                        <li>
                                            <a href="signin.html"><i class="fas fa-envelope"></i></a>
                                        </li>
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

        public function showProductoId(){
            $id_prod = $_POST['id'];
            productosModelo::showProductoId_M($id_prod);
        }
		
        
        // ********************

        public function listaBanner(){
            $banners = productosModelo::listaBanner_M();
            $div = '';
            foreach ($banners as $banner) {
                $fot = $banner->foto_url;
                $div .= '<div class="hero-slide hero-slide--4" >
                        

                        <div class="primary-style-2-container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider-content slider-content--animation">
            
                                        <span class="content-span-1 u-c-white">'.$banner->prod_nombre.'</span>
            
                                        <span class="content-span-2 u-c-white">15% de descuento</span>
            
                                        <span class="content-span-4 u-c-white">Precio de locura
                                            <span class="u-c-brand">S/. '.$banner->prod_precio.'</span></span>
            
                                        <a class="shop-now-link btn--e-brand" href="'.SERVERURL.'categoria/'.$banner->cat_nombre.'">COMPRAR AHORA</a></div>
                                </div>
                            </div>
                        </div>
                        <img src="'.SERVERURL.'admin'.$fot.'" alt="Paris" width="300" height="300">
                    </div>';
            }
            echo $div;
        }

        public function listaEletronicos(){
            $elects = productosModelo::listaProductos('');
            $div =  '<div class="tab-content"> ';
            $tipo1 = '';
            $tipo2 = '';
            foreach ($elects as $elect) {
                $foto = productosModelo::fotoProducto($elect->id_prod);
                // <img class="" src="'.SERVERURL.'admin'.$foto->foto_t.'" alt=""></a>
                
                if($elect->id_cat == 1){
                    $tipo1 .='      
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on">
                                <div class="product-o__wrap">

                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                        <img class="aspect__img" src="'.SERVERURL.'admin/'.$foto->foto_url.'" alt=""></a>
                                    <div class="product-o__action-wrap">
                                        <ul class="product-o__action-list">
                                            <li>

                                                <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick View" onclick="verDetalle('.$elect->id_prod.')"><i class="fas fa-search-plus"></i></a></li>
                                            <li>

                                                <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-plus-circle"></i></a></li>
                                    </ul>
                                    </div>
                                </div>

                                <span class="product-o__category">
                                    <a href="'.SERVERURL.'categoria/'.$elect->cat_nombre.'">'.$elect->cat_nombre.'</a>
                                </span>

                                <span class="product-o__name">
                                    <a href="categoria/'.$elect->cat_nombre.'">'.$elect->prod_nombre.'</a>
                                </span>      
                                <div class="product-o__rating gl-rating-style">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>

                                    <span class="product-o__review">(23)</span>
                                </div>

                                <span class="product-o__price">S/. '.$elect->prod_precio.'</span>    
                            </div>
                        </div>
                        
                        
                        ';
                }
                elseif($elect->id_cat == 2){
                    $tipo2 .='   
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                        <img class="aspect__img" src="'.SERVERURL.'admin/'.$foto->foto_url.'" alt=""></a>
                                    <div class="product-o__action-wrap">
                                        <ul class="product-o__action-list">
                                            <li>

                                                <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick View" onclick="verDetalle('.$elect->id_prod.')"><i class="fas fa-search-plus"></i></a></li>
                                            <li>

                                                <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-plus-circle"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="product-o__category">
                                    <a href="'.SERVERURL.'categoria/'.$elect->cat_nombre.'">'.$elect->cat_nombre.'</a>
                                </span>

                                <span class="product-o__name">
                                    <a href="categoria/'.$elect->cat_nombre.'">'.$elect->prod_nombre.'</a>
                                </span>      
                                <div class="product-o__rating gl-rating-style">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>

                                    <span class="product-o__review">(23)</span>
                                </div>

                                <span class="product-o__price">S/. '.$elect->prod_precio.'</span>    
                            </div>
                        </div>';
                }
            }
            
            $div .= '
                    <div class="tab-pane" id="e-l-p">
                        <div class="slider-fouc">
                            <div class="owl-carousel tab-slider" data-item="4">
                                '.$tipo1.'
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="e-b-s">
                        <div class="slider-fouc">
                            <div class="owl-carousel tab-slider" data-item="4">
                                '.$tipo2.'
                            </div>
                        </div>
                    </div>
            </div>';
            echo $div;
        }

        public function productos($categoria){
            $prods = productosModelo::all_productos_M($categoria);          
            return $prods;
        }
        public function buscarProducto(){
            $text = $_POST['search'];
            $prods = productosModelo::buscarProducto_M($text);          
            // return $prods;
        }

        
	}  