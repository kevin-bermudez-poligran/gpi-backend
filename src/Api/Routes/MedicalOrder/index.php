<?php
    use GpiPoligran\Api\Routes\MedicalOrder\{
        CreateMedicalOrder,
        GetMedicalOrders
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/medical-orders";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new CreateMedicalOrder( $req,$res );
        return $routeHandler->run();
    });

    $router->get("$prefix", function($req,$res){
        $routeHandler = new GetMedicalOrders( $req,$res );
        return $routeHandler->run();
    });