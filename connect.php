<?php
require 'vendor/autoload.php';
require 'config.php';


use GuzzleHttp\Client;
$client = new Client([

    'timeout'  => 2.0,
    'verify' => true
]);
try{
    $response = $client->request('GET', 'https://accounts.google.com/.well-known/openid-configuration');
    $discoveryJson = json_decode((string)$response->getBody());
    $tokenEndpoint = $discoveryJson->token_endpoint;
    $userinfoendpoint = $discoveryJson->userinfo_endpoint;
    $response = $client->request('POST', $tokenEndpoint,[
        'form_params' =>[
            'code' => $_GET["code"],
            'client_id' => GOOGLE_ID,
            'client_secret' => GOOGLE_SECRET,
            'redirect_uri' => "http://localhost:8888/sdk/connect.php",
            'grant_type' => "authorization_code"
        ]
    ]);
    $access_token =json_decode($response->getBody())->access_token;
    $response = $client->request('GET', $userinfoendpoint, [
        'headers'=> [
            'Authorization' => 'Bearer'.$access_token
        ]
    ]);

    $response = json_decode($response->getBody());
    if ($response->email_verified === true){
        session_start();
        $_SESSION["email"] = $response->email;
        header("Location: /sdk/secret.php");
        exit();
    }

}catch (\GuzzleHttp\Exception\ClientException $exception){
    dd($exception->getMessage());
}

dd((string)$response->getBody());