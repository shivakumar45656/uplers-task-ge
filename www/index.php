<?php
require_once 'autoloader.php';
require_once 'src/Middlewares/executor.php';

use src\Middlewares\SqlInjection;
use src\Routes\Router;
use function src\Middlewares\middlewareExecutor;
// echo $_SERVER['QUERY_STRING'].'<br>';
// echo $_SERVER['REQUEST_METHOD'].'<br>';
// echo $_SERVER['REQUEST_URI'].'<br>';

SqlInjection::verify($_SERVER['QUERY_STRING']); //since every url needs to be checked for injection via query strings
$Router = new Router($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING'],$_SERVER['REQUEST_METHOD']);
$routeInfo = $Router->route();
$headers = getallheaders();
$metaData = [
    'headers' => $headers
];
// var_dump($metaData);
$middlewareResult = middlewareExecutor($metaData,$routeInfo['middleware']);
if(!$middlewareResult['status']) {
    http_response_code(401);
    echo json_encode([
        'statusCode' => 401,
        'Message' => $middlewareResult['message']
    ]);
}


    
