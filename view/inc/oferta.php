<!--====== Newsletter Subscribe Modal ======-->
<div class="modal fade new-l" id="newsletter-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">

            <button class="btn new-l__dismiss fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div id="alertaloginn" class="text-center"></div>
                
                <div class="row u-s-m-x-0">
                    <div class="col-lg-6 new-l__col-2">
                        <div class="new-l__section u-s-m-t-30">
                            <div class="u-s-m-b-8 new-l--center">
                                <h3 class="new-l__h3">Registrarse</h3>
                            </div>
                            <div class="u-s-m-b-30 new-l--center">
                                <!-- <p class="new-l__p1">Sign up for emails to get the scoop on new arrivals, special sales and more.</p> -->
                            </div>
                            <!-- <form class="new-l__form"> -->
                                <div class="u-s-m-b-15">

                                    <input class="news-l__input" id="nom_reg" type="text" placeholder="Nombre">
                                </div>
                                <div class="u-s-m-b-15">

                                    <input class="news-l__input" id="user_reg" type="text" placeholder="Email">
                                </div>
                                <div class="u-s-m-b-15">

                                    <input class="news-l__input" id="pass_reg" type="text" placeholder="Contraseña">
                                </div>
                                <div class="u-s-m-b-15">

                                    <button class="btn btn--e-brand" type="submit" onclick="registrarseCliente()" >Registrarme!</button>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <div class="col-lg-6 new-l__col-2">
                        <div class="new-l__section u-s-m-t-30">
                            <div class="u-s-m-b-8 new-l--center">
                                <h3 class="new-l__h3">Iniciar Session</h3>
                            </div>
                            <div class="new-l__form">
                                <div class="u-s-m-b-15">

                                    <input class="news-l__input" id="user" type="text" placeholder="Correo o correo electronico">
                                </div>
                                <div class="u-s-m-b-15">

                                    <input class="news-l__input" id="pass" type="password" placeholder="Contraseña">
                                </div>
                                <div class="u-s-m-b-15">
                                    
                                    <button class="btn btn--e-brand" type="submit"  onclick="IniciarSession()">Aceptar</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Newsletter Subscribe Modal ======-->


<div class="modal fade new-l" id="cuentaLogueado">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">

            <button class="btn new-l__dismiss fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row u-s-m-x-0">
                    
                    <div class="col-lg-12 new-l__col-2">
                        <div class="new-l__section u-s-m-t-30">
                            <div class="u-s-m-b-8 new-l--center">
                                <h3 class="new-l__h3">Mi cuenta</h3>
                            </div>
                            <div class="new-l__form" id="cuentaLogin">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

