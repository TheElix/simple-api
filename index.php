<?php
header('Content-Type: application/json');

require 'api/SayHello.php';
require 'api/GetBase64.php';
require 'api/SayHelloInLanguage.php';

$apiMethod = explode('/',$_SERVER['REQUEST_URI']);

switch ($apiMethod[2]){
    case "sayHello":

        $api = new SayHello($_POST['name']);

        echo $api->getResponse();
        $api->getResponseCode();

        break;
    case "getBase64":

        $api = new GetBase64($_FILES['data']['tmp_name']);

        echo $api->getResponse();
        $api->getResponseCode();

        break;
    case "sayHelloInLanguage":

        $api = new SayHelloInLanguage($_POST['name'], $_POST['language']);

        echo $api->getResponse();
        $api->getResponseCode();

        break;
    default:
        echo json_encode([
            "status" => "Error",
            "msg" => "Method not allowed"
        ]);
        break;
}