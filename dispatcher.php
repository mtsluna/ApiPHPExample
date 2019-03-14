<?php

//Permite los origenes desconocidos y los metodos GET, POST, PUT, DELETE
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

//Analisis de URI
$uri = explode("/", $_SERVER['REQUEST_URI']);
//Analisis del body que se pasa por debajo
$body = file_get_contents("php://input");
$response;

analizeUri($uri, $body);

function analizeUri($uri, $body){
    
    if(count($uri) == 5){
        if(strlen($uri[0]) == 0 && strlen($uri[4]) == 0 && $uri[1] == 'api'){
            
            $controller = ucwords(strtolower($uri[2])).'Controller';
            $method = $uri[3];
                        
            $response = checkController($controller, $method, $body);
            
        }
        else{
            $response = array("response" => 'Invalid URI.');
        }  
    }
    else{
        $response = array("response" => 'Invalid URI.');
    }
    echo json_encode($response);
}

function checkController($controller, $method, $body){
    if (!file_exists('./Controllers/' . $controller . '.php')) {
        return array("response" => 'Invalid URI.');
    }
    else{
        require_once './Controllers/' . $controller . '.php';

        $data = json_decode($body,true);
        $controller = new $controller($data); 
        
        if(method_exists($controller, $method)){
            $result = $controller->$method();
        }
        else{
            return array("response" => 'Invalid method.');
        }
        
        return array("response" => $result);
    }
}

