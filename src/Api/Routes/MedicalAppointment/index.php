<?php
    use GpiPoligran\Api\Routes\MedicalAppointment\{
        CreateMedicalAppointment
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/medical-appointments";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new CreateMedicalAppointment( $req,$res );
        return $routeHandler->run();
    });