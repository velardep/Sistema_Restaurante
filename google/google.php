<?php
require_once '../vendor/autoload.php'; // Asegúrate de que has instalado la librería google-api-php-client mediante Composer

// Configuración de la aplicación y autenticación
$client = new Google_Client();
$client->setAuthConfig('client_secret.json'); // Ruta al archivo JSON que contiene las credenciales de la aplicación
$client->addScope(Google_Service_PeopleService::USERINFO_PROFILE); // Solicita acceso al perfil del usuario
$client->addScope(Google_Service_PeopleService::USERINFO_EMAIL); // Solicita acceso al email del usuario
$client->setRedirectUri('http://localhost/ARQproject/google/oauth2callback.php'); // URL de redireccionamiento después de la autenticación

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);

    // Crear el servicio de People
    $service = new Google_Service_PeopleService($client);

    // Obtener la información del perfil del usuario
    $me = $service->people->get('people/me');
    $name = $me->getNames()[0]->getDisplayName();
    $email = $me->getEmails()[0]->getValue();

    $data = array();
    $data[] = array(
        "name" => $name,
        "email" => $email
    );

    echo json_encode($data);
} else {
    // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}
