<?php
    use GpiPoligran\Api\Routes\MedicalOrder\{
        CreateMedicalOrder
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/medical-orders";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new CreateMedicalOrder( $req,$res );
        return $routeHandler->run();
    });