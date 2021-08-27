<div id="pedidos">
    <div >
        <?php 
            require_once './controladores/pedidosControlador.php';
            $listaPedidos = new pedidosControlador();
            echo $listaPedidos -> listaPedidos_c();           
        ?>
    </div>
    
    <!-- DETALLE DEL PEDIDO -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Detalle de pedido</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="text-center">
            <!-- <h3>Monto : S/. {{total}}.00</h3> -->
            
            
        </div>
        <div class="offcanvas-body small">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">SubTotal</th>
                    <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody id="pedidosC">
                   
                        
                       
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="showclienteP">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
    

</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script>


    function verLista(idPedido){
        idUser = '<?php echo $_SESSION['id_bot'] ?>'
        console.log(idUser);
        url = "../ajax/pedidosAjax.php"
        // estad = estado == 1 ? false: true; /* 1 atentido, 0 sin atender */
        idPedid = idPedido;
        let datos = new FormData();
        datos.append('idPedido',idPedido);
        fetch(url, {
            method : 'POST',
            body : datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            console.log(respuesta);
            li=''
            respuesta.forEach(prod => {
                if(prod.usuario_id_usu == idUser){
                    est = prod.estado == 1 ? `<span  class="badge bg-primary">El pedido fue atentido</span>` : `<input type="button" value="Atendido" onclick=atentido(${prod.id_detped},${idPedido})>`
                    estado = `<div class="text-left">
                                ${est}
                            </div>`
                }else{
                    estado = `Otra Tienda`
                }
                li+=`  <tr > <th scope="row">1</th>
                        <td>${prod.detped_cantidad}</td>
                        <td>${prod.prod_nombre}</td>
                        <td>${prod.prod_precio}</td>
                        <td>${prod.detped_cantidad*prod.prod_precio}</td>
                        <td>
                            ${estado}
                        </td></tr> `
            });
            document.getElementById('pedidosC').innerHTML = li 
        })
    }

    function atentido(id_detped,idPedido){
        console.log(id_detped);
        url = "../ajax/pedidosAjax.php"
        let datos = new FormData();
        datos.append('estado',id_detped);
        // datos.append('estado',1);
        fetch(url,{
            method : 'POST',
            body : datos,
        })
        .then(respuesta => respuesta.text())
        .then(respuesta => {
            verLista(idPedido)
        })

    }

    function detalCliente(idCliente){
        url = '../ajax/pedidosAjax.php'
        console.log(idCliente);
        DATOS = new FormData()
        DATOS.append('idC',idCliente)
        DATOS.append('showClP','showClP')
        fetch(url,{
            method : 'POST',
            body : DATOS
        })
        .then( resp => resp.json())
        .then( resp => {
            console.log(resp);
            datos = `
                <div>
                    <h5>TELEFONO : ${resp.cli_celular}</h5>
                    <h5>DIRECCIÓN : ${resp.cli_direccion}</h5>
                    <h5>EMAIL: ${resp.cli_user}</h5>
                </div>
            `
            document.getElementById('showclienteP').innerHTML = datos 
        })
    }

</script>
