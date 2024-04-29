<?php
    namespace GpiPoligran\Api\Routes\System;
    use GpiPoligran\Api\Routes\RouteBase;

    final class Healtcheck extends RouteBase{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        public function run(){
            return RouteBase::sendResponse( $this->response,200,'Api GPI Poligran OK' );    
        }
    }