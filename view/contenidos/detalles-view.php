
<?php 
    $ruta = explode('/',$_GET['ruta']);
    if (isset($ruta[1])) {
        $categoria = $ruta[1];
    } else {
        $categoria = '';
    }
    include 'controller/productosControlador.php';
    $prods = new productosControlador();
    
    $lista = $prods->productos($categoria);			
?>
<!--====== App Content ======-->
<div class="app-content">
    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">DETALLE DE PEDIDOS</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="s" style="margin:100px">
                <div class="row" id="resultadoPed">
                    


                    <div class="col-lg-9 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table-p">
                                <tbody id="carritoP">

                                    <!--====== Row ======-->
                                    <!-- MOSTRAR PEDIDOS -->
                                    <!--====== End - Row ======-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="f-cart__pad-box" id="costoPed">
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
    <div class="u-s-p-b-90">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">TAMBIEN COMPRARON ESTOS PRODUCTOS</h1>

                            <span class="section__span u-c-grey">PRODUCTOS MAS VENDIDOS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="slider-fouc">
                    <div class="owl-carousel product-slider" data-item="4" id="otrosProductos">
                        
                        <!-- ********************************** -->        
                        <?php 
                            foreach ($lista as $prod) {
                                echo '
                                <div class="u-s-m-b-30">
                                    <div class="product-o product-o--hover-on">
                                        <div class="product-o__wrap">
        
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
        
                                                <img class="aspect__img" src="'.SERVERURL.'admin/'.$prod->foto_url.'" alt=""></a>
                                            <div class="product-o__action-wrap">
                                                <ul class="product-o__action-list">
                                                    <li>
        
                                                        <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" 
                                                        data-placement="top" title="Quick View"><i class="fas fa-search-plus"  onclick="verDetalle('.$prod->id_prod.')"></i></a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
        
                                        <span class="product-o__category">
        
                                            <a href="'.SERVERURL.'categoria/'.$prod->cat_nombre.'">'.$prod->cat_nombre.'</a></span>
        
                                        <span class="product-o__name">
        
                                        <a href="#">'.$prod->prod_nombre.'</a></span>
                                        <div class="product-m__price">S/. '.$prod->prod_precio.'</div>
                                            <div class="product-m__hover">
                                                <div class="product-m__preview-description">

                                                   
                                                    </div>
                                                    
                                            </div>
                                    </div>
                                </div>



                               
                                
                                ';
                            }
                        ?>        
                        <!-- ********************************** -->                
                       
                        <!-- ********************************** -->


                    </div>
                </div>
            </div>
        </div>
    <!--====== End - Section Content ======-->
    </div>

</div>
<!--====== End - App Content ======-->

<script>
    leerPedidos()
    listaProducMas()
    listarProductos()

function leerPedidos(){
    serverURL = '<?php echo SERVERURL ?>'
    if (localStorage.getItem("pedidos")) {
            
        carrito = JSON.parse(localStorage.getItem("pedidos"))
        if(carrito.length>0){
            total = carrito.reduce((sum, li) => sum + li.cantidad*li.precio, 0)
            div =''
            carrito.forEach(prod => {
                div += `
                    <tr>
                        <td>
                            <div class="table-p__box">
                                <div class="table-p__img-wrap">

                                    <img class="u-img-fluid" src="${serverURL}admin${prod.foto}" alt=""></div>
                                <div class="table-p__info">

                                    <span class="table-p__name">

                                        <a href="product-detail.html">${prod.nombre}</a></span>

                                    <span class="table-p__category">

                                        <a href="shop-side-version-2.html">${prod.cat}</a></span>
                                    <ul class="table-p__variant-list">
                                        <li>

                                            <span>Size: 22</span></li>
                                        <li>

                                            <span>Color: Red</span></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td>

                            <span class="table-p__price">S/.${prod.precio}</span></td>
                        <td>
                            <div class="table-p__input-counter-wrap">

                                <!--====== Input Counter ======-->
                                <div class="input-counter">

                                    <span class="input-counter__minus fas fa-minus" onclick="cantidadProd2(false, ${prod.id}, '${prod.talla}', '${prod.color}')"></span>
                                    <input class="input-counter__text input-counter--text-primary-style" 
										type="text" value="${prod.cantidad}" min="1" data-max="1000" id="cantPro">
                                    
                                    <span class="input-counter__plus fas fa-plus" onclick="cantidadProd2(true, ${prod.id}, '${prod.talla}', '${prod.color}')"></span>
                                <!--====== End - Input Counter ======-->
                            </div>
                        </td>
                        <td>
                            <div class="table-p__del-wrap">

                                <a class="far fa-trash-alt table-p__delete-link" href="#"></a></div>
                        </td>
                    </tr>`
            });
            
            costoPedido = `<div class="u-s-m-b-30">
                                        <table class="f-cart__table">
                                            <tbody>
                        <tr>
                            <td>PRODUCTOS</td>
                            <td>S/. ${total}</td>
                        </tr>
                        <tr>
                            <td>DELIVERY</td>
                            <td>S/ 0.00</td>
                        </tr>
                        <tr>
                            <td>SUBTOTAL</td>
                            <td>S/. ${total}</td>
                        </tr>
                        <tr>
                            <td>TOTAL</td>
                            <td>S/. ${total}</td>
                        </tr></tbody>
                                        </table>
                                    </div>
                                    <div>

                                        <button class="btn btn--e-brand-b-2" type="submit" onclick="verificarUser()"> PEDIR AHORA</button></div>`
            document.getElementById('carritoP').innerHTML = div
            document.getElementById('costoPed').innerHTML = costoPedido
        }
        else{
            console.log('vacio');
        }
        

    }
}

function cantidadProd2(tipo, id, talla, color){

    carrito = JSON.parse(localStorage.getItem("pedidos"))
    console.log(carrito);
    cant = tipo ?1 :-1 
    if (carrito.some( venta => venta.id == id && venta.talla == talla && venta.color == color)) {
    
        const ventaExites = carrito.map( venta => {
            if( venta.id == id && venta.talla == talla && venta.color == color ) {
                venta.cantidad += cant;
                return venta;
            } else {
                return venta;
            }
        })
        carrito = [...ventaExites];
    }else{
        // carrito.push(datos);
        console.log('error');
    }
        
    localStorage.setItem("pedidos",JSON.stringify(carrito))
    leerPedidos()
}

function verificarUser(){
    serverURL = '<?php echo SERVERURL ?>'
    url = serverURL+'ajax/logueoAjax.php'
    if(localStorage.getItem('user')){
        user = JSON.parse(localStorage.getItem('user'))
        // location.href =`${serverURL}pedidos`
        console.log('logueado');
        datos = new FormData()
        datos.append('id',user.id)
        datos.append('user',user.user)
        datos.append('token',user.token)
        datos.append('token2',user.token2)

        fetch(url,{
            method:'post',
            body : datos
        })
        .then(r => r.text())
        .then(r => {
            if (r == 'b') {
                console.log('ya esta en camino tu pedido');
                mandarPedido()
            }
            else{
                localStorage.removeItem('user');
                $('#newsletter-modal').modal('show');
            } 
            // else if(r=='ei') {
                
            // } else if(r=='ne') {
            //     localStorage.removeItem('user');
            //     $('#newsletter-modal').modal('show');
            // } else if(r=='td') {
            //     localStorage.removeItem('user');
            //     $('#newsletter-modal').modal('show');
            // }
        })
    }else{
        $('#newsletter-modal').modal('show');
        // console.log('sin logueado');

    }
}

function mandarPedido(){
    if(localStorage.getItem('pedidos')){
        carrito = JSON.parse(localStorage.getItem("pedidos"))
        if(carrito.length>0){
            serverURL = '<?php echo SERVERURL ?>'
            url = serverURL+'ajax/pedidoAjax.php'
            pedidos = JSON.parse(localStorage.getItem('pedidos'))
            total = pedidos.reduce((sum, li) => sum + li.cantidad*li.precio, 0)
            user = JSON.parse(localStorage.getItem('user'))
            
            fecha = new Date()
            idAl = Math.floor(Math.random()*10001)+1000;
            codigo = `${fecha.getDate()}${fecha.getMonth()}${fecha.getFullYear()}_${fecha.getHours()}${fecha.getMinutes()}${fecha.getSeconds()}_${idAl}`
            console.log(codigo);
            datos = new FormData()
            datos.append('total', total)
            datos.append('codigo', codigo)
            datos.append('user', user.id)
            fetch(url, {
                method : 'POST',
                body : datos,
            })
            .then(r => r.json())
            .then(r => {
                if (r == 'b') {
                    console.log('bien ');
                    pedidos.forEach(prod => {
                
                        datosd = new FormData()
                        datosd.append('id_prod', prod.id)
                        datosd.append('precio', prod.precio)
                        datosd.append('cantidad', prod.cantidad)
                        datosd.append('codigo_ped', codigo)
                        datosd.append('color', prod.color)
                        datosd.append('talla', prod.talla)
                        fetch(url, {
                            method : 'POST',
                            body : datosd,
                        })
                        .then(r => r.json())
                        .then(r => {
                            console.log(r)
                            if (r == 'bb') {
                                console.log('todo bien!!');
                                localStorage.removeItem('pedidos');
                                alerta = `<h2 class="resultad-enviado">
                                            Tu pedido fue enviado con exito, en unos momentos nos estaremos comunicando contigo!... 
                                        </h2>`
                                document.getElementById('resultadoPed').innerHTML = alerta
                                setTimeout( () => {
                                    location.href = `${serverURL}`;
                                },3000)
                            } else {
                                console.log('algo mal');
                            }
                        })
                    });
                } else {
                    console.log('no se pudo guardar el pedido');
                }
                // console.log(r);
            })
        }else{
            console.log('vaciooo');
        }
        

    }else{
        console.log('sin pedidos');
    }
}

function listaProducMas(){
    serverURL = '<?php echo SERVERURL ?>' 
    url = serverURL+'ajax/pedidoAjax.php'
    datos = new FormData()
    datos.append('listaProd','listaProd')
    fetch(url,{
        method:'post',
        body : datos
    })
    .then(r => r.json())
    .then(r => {
        console.log(r);
    })
}

function listarProductos(){
    console.log('holaa');
}

    
</script>

<style>
    .resultad-enviado{
        background-color: sandybrown;
    }
</style>