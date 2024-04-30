<?php

use GpiPoligran\Api\Routes\SpecialistSchedule\{
    CreateSpecialistSchedule,
    EditSpecialistSchedule,
    DeleteSpecialistSchedule
};
use GpiPoligran\Config\Constants;

$prefix = Constants::API_V1_PREFIX . "/specialist-schedules";

$router->put("$prefix/:specialist_schedule", function($req,$res){
    $routeHandler = new EditSpecialistSchedule( $req,$res );
    return $routeHandler->run();
});

$router->post("$prefix", function($req,$res){
    $routeHandler = new CreateSpecialistSchedule( $req,$res );
    return $routeHandler->run();
});

$router->delete("$prefix/:specialist_schedule", function($req,$res){
    $routeHandler = new DeleteSpecialistSchedule( $req,$res );
    return $routeHandler->run();
});