<?php
    use GpiPoligran\Api\Routes\MedicalExamination\UploadMedicalExamination;
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/medical-examinations";

    $router->post("$prefix", function($req,$res){
        $routeHandler = new UploadMedicalExamination( $req,$res );
        return $routeHandler->run();
    });