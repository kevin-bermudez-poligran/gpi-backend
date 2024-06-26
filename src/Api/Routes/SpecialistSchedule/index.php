<?php

use GpiPoligran\Api\Routes\SpecialistSchedule\{
    CreateSpecialistSchedule,
    EditSpecialistSchedule,
    DeleteSpecialistSchedule,
    GetSpecialistSchedulesBySpecialist,
    GetSpecialistSchedulesById
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

$router->get("$prefix/:specialist", function($req,$res){
    $routeHandler = new GetSpecialistSchedulesBySpecialist( $req,$res );
    return $routeHandler->run();
});

$router->get("$prefix-by-id/:id", function($req,$res){
    $routeHandler = new GetSpecialistSchedulesById( $req,$res );
    return $routeHandler->run();
});