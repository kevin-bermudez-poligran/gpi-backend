<?php
    use GpiPoligran\Api\Routes\MedicalAppointment\{
        CreateMedicalAppointment,
        EditMedicalAppointment,
        DeleteMedicalAppointment
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/medical-appointments";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new CreateMedicalAppointment( $req,$res );
        return $routeHandler->run();
    });

    $router->put("$prefix/:medical_appointment", function($req,$res){
        $routeHandler = new EditMedicalAppointment( $req,$res );
        return $routeHandler->run();
    });

    $router->delete("$prefix/:medical_appointment", function($req,$res){
        $routeHandler = new DeleteMedicalAppointment( $req,$res );
        return $routeHandler->run();
    });