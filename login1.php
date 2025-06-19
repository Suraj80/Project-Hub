<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('1943414762-28fosds1hokjs3fm57vvqgoun49gjkpl.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/projecthub/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

$authUrl = $client->createAuthUrl();
header('Location:' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
?>
