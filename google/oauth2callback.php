<?php
require_once '../vendor/autoload.php'; // Asegúrate de que has instalado la librería google-api-php-client mediante Composer
require_once '../model/Cliente.php';

session_start();

$cliente = new Cliente();

// Configuración del cliente de Google
$client = new Google_Client();
$client->setAuthConfig('client_secret.json'); // Ruta al archivo JSON que contiene las credenciales de la aplicación
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE); // Solicita acceso al perfil del usuario
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL); // Solicita acceso al email del usuario
$client->setRedirectUri('http://localhost/ARQproject/google/oauth2callback.php'); // URL de redireccionamiento después de la autenticación

// Manejar el código de autorización devuelto después de la autenticación
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Obtén la información del perfil del usuario
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $clientenombre = $google_account_info->name;
    $clienteemail = $google_account_info->email;
    $idcliente = $google_account_info->id;

    // Establecer las variables de sesión
    $_SESSION['clientenombre'] = $clientenombre;
    $_SESSION['clienteemail'] = $clienteemail;
   

    // Insertar cliente en la base de datos
    
    $cliente->insertarcliente($clientenombre, $clienteemail);
    
    $rol = $cliente->verificarcredencial($clientenombre,$clienteemail);
    $_SESSION['rol'] = $rol;
    // Redirigir al usuario a la página principal del cliente
   
    if ( $rol == 1) {
        header('Location: ../view/index_admin.php');
        exit();
    
    } else  {
    header('Location: ../view/index_cliente.php');
        exit();
    }
    exit();
   

} else {
    // Redirigir al usuario a la página de autenticación de Google
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
}