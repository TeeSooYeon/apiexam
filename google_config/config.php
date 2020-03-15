<?php

//config.php for google

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('345807680937-5ac3lbkn30nom6qn95pa6ib8t6v7n7jv.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('08eTbAAUQxcS5q7ezljMYnE2');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://apiexamsnh.herokuapp.com/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//to start session on web page
session_start();

?>