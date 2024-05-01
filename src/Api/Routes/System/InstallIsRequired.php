<?php
    namespace GpiPoligran\Api\Routes\System;
    use GpiPoligran\Api\Routes\RouteBase;
    use GpiPoligran\Services\System\InstallIsRequired as InstallIsRequiredService;

    final class InstallIsRequired extends RouteBase{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        public function run(){
            try{
                $service = new InstallIsRequiredService();
                return $this->sendResponse( 200,'Install is required',[
                    'install_is_required' => $service->register()
                ] );    
            }
            catch(\Exception $error){
                return $this->sendResponse( 200,'Install is required',[
                    'install_is_required' => true
                ] ); 
                // return $this->handlerException( $error );
            }
        }
    }