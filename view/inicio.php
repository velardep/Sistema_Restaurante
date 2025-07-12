<?php
include("header.php");
session_start();

?>


<div id="home" class="header">
    <div class="overlay text-white text-center">
        <h1 class="display-2 font-weight-bold my-3">Food Hut</h1>
        <h2 class="display-4 mb-5 my-3">Sabores que deleitan el alma</h2>
        <a class="btn btn-lg btn-primary" href="#blog">Descubre nuestro menú</a>
    </div>
</div>


<!--  About Section  -->
<div id="about" class="container-fluid wow fadeIn" id="about" data-wow-duration="1.5s">
    <div class="row">
        <div class="col-lg-6 has-img-bg"></div>
        <div class="col-lg-6">
            <div class="row justify-content-center">
                <div class="col-sm-8 py-5 my-5">
                    <h2 class="mb-4">Acerca de Nosotros</h2>
                    <p>¡Bienvenidos a FoodHut! Somos mucho más que un simple restaurante; somos un destino gastronómico donde la pasión por la comida se fusiona con la creatividad y la hospitalidad para ofrecerte una experiencia única.<br>
                        <br>En FoodHut, creemos en la importancia de cada ingrediente, cada técnica culinaria y cada detalle de servicio. Nuestro equipo de chefs apasionados está comprometido con la excelencia en cada plato que servimos, utilizando ingredientes frescos y de la más alta calidad para ofrecerte sabores auténticos y deliciosos.
                    <p><b>Nuestro menú está cuidadosamente diseñado para satisfacer todos los gustos y preferencias, desde platillos clásicos hasta creaciones innovadoras que sorprenden y deleitan. Ya sea que estés buscando una comida reconfortante o una experiencia culinaria única, en FoodHut encontrarás exactamente lo que deseas.</b></p>
                    <p>Gracias por elegir FoodHut. Estamos emocionados de tenerte con nosotros y esperamos que disfrutes de tu experiencia culinaria con nosotros. ¡Bienvenido a FoodHut, donde los sabores se encuentran con la hospitalidad en cada bocado!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Seccion del menú -->
<div id="blog" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
    <h2 class="section-title py-5">Nuestro Menu</h2>
    <div class="row justify-content-center">
        <div class="col-sm-7 col-md-4 mb-5">
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <!-- BOTONES  -->
                <li class="nav-item">
                    <a class="nav-link active" id="pills-foods-tab" data-toggle="pill" href="#foods" role="tab" aria-controls="pills-foods" aria-selected="true">Platillos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-juice-tab" data-toggle="pill" href="#juice" role="tab" aria-controls="pills-juice" aria-selected="false">Bebidas</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- Seccion de platillos -->
    <div class="tab-pane fade show active" id="foods" role="tabpanel" aria-labelledby="pills-foods-tab">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card bg-transparent border my-3 my-md-0">
                    <div class="row" id="card">
                        <!-- Cada platillo se insertara aqui -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seccion de jugos -->
    <div class="tab-pane fade" id="juice" role="tabpanel" aria-labelledby="pills-juice-tab">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card bg-transparent border my-3 my-md-0">
                    <div class="row" id="card2">
                        <!-- Cada jugo se insertara aqui -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Seccion de contacto  -->
<div id="contact" class="container-fluid bg-dark text-light border-top wow fadeIn">
    <div class="row">
        <div class="col-md-6 px-0 my-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d927.8382916378487!2d-64.73226873046151!3d-21.533041751261223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjHCsDMxJzU5LjAiUyA2NMKwNDMnNTMuOSJX!5e0!3m2!1ses-419!2sbo!4v1716596248545!5m2!1ses-419!2sbo" class="w-100 h-100"></iframe>
        </div>
        <div class="col-md-6 px-5 has-height-lg middle-items ">
            <h3 class="mx-auto my-1">Contáctanos</h3>
            <p>En Food Hut, valoramos la conexión con nuestros comensales. Si tiene alguna pregunta, comentario o desea hacer una reserva, no dude en ponerse en contacto con nosotros. Nuestro equipo de atención al cliente estará encantado de asistirle.</p>
            <div class="text-muted">
                <p><span class="ti-location-pin pr-3"></span>Calle Colón entre Bolivar e Ingavi</p>
                <p><span class="ti-mobile pr-3"></span>+353 83 009 7233</p>
                <p><span class="ti-email pr-3"></span>foodhut@gmail.com</p>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>

<script type="text/javascript" src="js/jugocliente.js"></script>

<script type="text/javascript" src="js/menucliente.js"></script>