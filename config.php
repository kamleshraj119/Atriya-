<?php

// OAUTH Configuration
$oauthClientID = '350637983834-fbppoeen6bcqslc4bjnk7e31rokdiiaa.apps.googleusercontent.com';
$oauthClientSecret = 'Q0FahNRRUk1LBO6odHwzuTCm';
//$baseURL = 'http://localhost:8080/skillchamps_site/';
$baseURL = 'http://localhost/skillchamps/flexihire/';
//$redirectURL = 'http://localhost:8080/skillchamps_site/candidate.php?action=videos';
$redirectURL = 'http://localhost/skillchamps/flexihire/candidate.php?action=videos';

define('OAUTH_CLIENT_ID',$oauthClientID);
define('OAUTH_CLIENT_SECRET',$oauthClientSecret);
define('REDIRECT_URL',$redirectURL);
define('BASE_URL',$baseURL);

// Include google client libraries
require_once 'google-api-php/autoload.php'; 
require_once 'google-api-php/Client.php';
require_once 'google-api-php/Service/YouTube.php';

session_start();

$client = new Google_Client();
$client->setClientId(OAUTH_CLIENT_ID);
$client->setClientSecret(OAUTH_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$client->setRedirectUri(REDIRECT_URL);

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);
    
?>