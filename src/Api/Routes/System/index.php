<?php
    use GpiPoligran\Api\Routes\System\Healtcheck;
    
    $router->get('api/healtcheck', function($req,$res){
        $routeHandler = new Healtcheck($req,$res);
        return $routeHandler->run();
    });