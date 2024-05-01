<?php
    use GpiPoligran\Api\Routes\Specialty\{
        CreateSpecialty,
        GetSpecialties
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/specialties";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new CreateSpecialty( $req,$res );
        return $routeHandler->run();
    });

    $router->get("$prefix", function($req,$res){
        $routeHandler = new GetSpecialties( $req,$res );
        return $routeHandler->run();
    });