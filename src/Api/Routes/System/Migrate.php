<?php

namespace GpiPoligran\Api\Routes\System;
use GpiPoligran\Api\Routes\RouteBase;

final class Migrate extends RouteBase{
    public function __construct($request,$response){
        parent::__construct($request,$response);
    }

    public function run(){
        try{
            return $this->sendResponse( 200,'Migrate DB ok' );    
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}