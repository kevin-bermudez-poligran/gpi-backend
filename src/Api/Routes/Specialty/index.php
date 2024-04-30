<?php
    use GpiPoligran\Api\Routes\Specialty\{
        CreateSpecialty
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/specialties";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new CreateSpecialty( $req,$res );
        return $routeHandler->run();
    });