<?php
    use GpiPoligran\Api\Routes\ClinicHistory\{
        GetClinicHistory
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/clinic-history";

    $router->get("$prefix", function($req,$res){
        $routeHandler = new GetClinicHistory( $req,$res );
        return $routeHandler->run();
    });