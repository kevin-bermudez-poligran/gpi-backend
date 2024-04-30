<?php
    namespace GpiPoligran\Api\Routes\System;
    use GpiPoligran\Api\Routes\RouteBase;

    final class Healtcheck extends RouteBase{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        public function run(){
            try{
                return $this->sendResponse( 200,'Api GPI Poligran OK' );    
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }