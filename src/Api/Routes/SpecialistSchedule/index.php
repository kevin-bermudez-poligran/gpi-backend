<?php

use GpiPoligran\Api\Routes\SpecialistSchedule\{
    CreateSpecialistSchedule
};
use GpiPoligran\Config\Constants;

$prefix = Constants::API_V1_PREFIX . "/specialist-schedules";

$router->post("$prefix", function($req,$res){
    $routeHandler = new CreateSpecialistSchedule( $req,$res );
    return $routeHandler->run();
});