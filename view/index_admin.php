<?php
include("header.php");
?>

<!-- Seccion del menú -->
<div id="blog" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
    <h2 class="section-title py-5">Editar Menú</h2>
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




    



<!-- Insertar platillos  -->
<form id="a" method="POST">
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items py-4" id="clientes">
        <div class="">
            <h2 class="section-title mb-5">Insertar platillos</h2>
            <div class="row mb-5">
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="hidden" name="idcomida" id="idcomida">
                    <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Nombre" maxlength="500" id="nombre" name="nombre" required>
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Tipo de comida" maxlength="500" id="tipo" name="tipo" required>
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Precio" maxlength="500" id="precio" name="precio" required>
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Descripción" maxlength="500" id="descripcion" name="descripcion" required>
                </div>
                <div class="col-md-3 col-xs-6 my-2 mx-auto">
                    <input type="file" class="form-control" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
                    <input type="hidden" name="imagenactual" id="imagenactual">
                    <img src="" width="300px" height="240px" id="imagenmuestra">
                </div>
            </div>
            <button class="btn btn-lg btn-primary" type="submit" id="btnGuardarMenu"><i class="bx bx-save"></i> Guardar</button>
        </div>
    </div>
</form>

 <!-- Insertar jugos  -->
 <form id="b" method="POST">
            <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items py-4" id="clientes">
                <div class="">
                    <h2 class="section-title mb-5">Insertar jugos</h2>
                    <div class="row mb-5">
                        <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                            <input type="hidden" name="idjugo" id="idjugo">
                            <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Nombre" maxlength="500" id="nombrejugo" name="nombrejugo" required>
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                            <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Tipo de jugo" maxlength="500" id="tipojugo" name="tipojugo" required>
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                            <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Precio" maxlength="500" id="preciojugo" name="preciojugo" required>
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                            <input class="form-control form-control-lg custom-form-control" type="text" placeholder="Descripción" maxlength="500" id="descripcionjugo" name="descripcionjugo" required>
                        </div>
                        <div class="col-md-3 col-xs-6 my-2 mx-auto">
                            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
                            <input type="hidden" name="imagenactualjugo" id="imagenactualjugo">
                            <img src="" width="300px" height="240px" id="imagenmuestrajugo">
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary" type="submit" id="btnGuardarJugos"><i class="bx bx-save"></i> Guardar</button>
                </div>
            </div>
        </form>

<?php
    include("footer.php");
?>
<script type="text/javascript" src="js/jugo.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/cliente.js"></script>
<script type="text/javascript" src="js/mesa.js"></script>




