<?php
    use GpiPoligran\Api\Routes\User\{
        CreateToken
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/users";

    $router->post("$prefix/login", function($req,$res){
        $routeHandler = new CreateToken( $req,$res );
        return $routeHandler->run();
    });