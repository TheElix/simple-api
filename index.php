<?php
header('Content-Type: application/json');

require 'api/SayHello.php';

$apiMethod = explode('/',$_SERVER['REQUEST_URI']);

switch ($apiMethod[2]){
    case "sayHello":

        $api = new SayHello($_POST['name']);

        echo $api->getResponse();
        $api->getResponseCode();

        break;
    case "getBase64":

        break;
    case "sayHelloInLanguage":

        break;
    default:
        echo json_encode([
            "status" => "Error",
            "msg" => "Method not allowed"
        ]);
        break;
}