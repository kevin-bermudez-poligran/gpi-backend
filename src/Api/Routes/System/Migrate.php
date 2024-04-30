<?php

namespace GpiPoligran\Api\Routes\System;
use GpiPoligran\Api\Routes\SuperAdminRoute;
use GpiPoligran\Services\DatabaseAdmin\Migrate as MigrateService;

final class Migrate extends SuperAdminRoute{
    public function __construct($request,$response){
        parent::__construct($request,$response);
    }

    public function run(){
        try{
            $service = new MigrateService();
            $service->register();
            
            return $this->sendResponse( 200,'Migrate DB ok' );    
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}