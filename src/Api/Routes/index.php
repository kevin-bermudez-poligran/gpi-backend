<?php
    use Express\Express;
    use Express\Router;
    
    $express = new Express();
    $router = new Router();

    require_once __DIR__ . '/System/index.php';
    require_once __DIR__ . '/User/index.php';

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, PUBLIC-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");


    $express->listen($router);