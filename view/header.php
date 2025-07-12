<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Devcrud">
    <title>FoodHut</title>
    <link rel="shortcut icon" href="../public_html/assets/imgs/logo.png" />

    <!-- font icons -->
    <link rel="stylesheet" href="../public_html/assets/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../public_html/assets/vendors/animate/animate.css">

    <!-- Bootstrap -->

    <link href="../public_html/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap + FoodHut main styles -->
    <link rel="stylesheet" href="../public_html/assets/css/foodhut.css">
    <style>
        .container-fluid {
            text-align: center;
            color: #fff;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }

        .main__link {
            display: inline-block;
            margin-bottom: 20px;
        }

        .main__icon {
            width: 50px;
            /* Ajusta el tamaño de la imagen aquí */
            height: auto;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">



    <!-- header -->
    <header class="custom-navbar" data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
        <!-- Navbar -->
        <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">¿Quiénes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reserva">Reservas</a>
                    </li>
                </ul>
                <a class="navbar-brand m-auto" href="#">
                    <img src="../public_html/assets/imgs/logo1.svg" class="brand-img">
                    <span class="brand-txt">Food Hut</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../view/inicio.php"> Cerrar Sesión</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../google/google.php"  class="main__link"> Iniciar Sesión</a>
                    </li>

                </ul>

            </div>

        </nav>
    </header>