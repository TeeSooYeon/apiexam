<?php

//config.php for facebook

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API 
// app Id and app Secret from creation of authentication

$facebook = new \Facebook\Facebook([
  'app_id'      => '626566744568306',
  'app_secret'     => '033f61fe00877f39eed2b85ebce12fd2',
  'default_graph_version'  => 'v2.10'
]);

//by Hans Ludwig Toquero
?>


