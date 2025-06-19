<?php
require_once 'vendor/autoload.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$client = new Google_Client();
$client->setClientId('1943414762-28fosds1hokjs3fm57vvqgoun49gjkpl.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/projecthub/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $oauth = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        $_SESSION['email'] = $userInfo->email;
        $_SESSION['name'] = $userInfo->name;

        header('Location: dashboard.php');
        exit;
    } else {
        echo "<h3>❌ Error from Google:</h3><pre>";
        print_r($token);
        echo "</pre>";
    }
} else {
    echo "<h3>⚠️ No authorization code in URL</h3>";
}
?>
