<?php
    namespace GpiPoligran\Api\Routes;
    use GpiPoligran\Api\Routes\RouteBase;
    use GpiPoligran\Utils\ManageJWT;
    use GpiPoligran\Utils\ManageCrypt;
    use GpiPoligran\Services\Users\GetInfoFromToken;

    class RoutePrivate extends RouteBase {
        private $rawToken;
        protected $currentUserData;

        public function __construct($request,$response){
            parent::__construct($request,$response);
            
            $this->getRawToken();
            $this->getDataToken();
        }

        private function getAuthorizationHeader(){
            if($this->request->headers['Authorization']){
                return $this->request->headers['Authorization'];
            }
            
            if($this->request->headers['authorization']){
                return $this->request->headers['authorization'];
            }

            return null;
        }

        private function getRawToken(){
            $authHeader = $this->getAuthorizationHeader();
            if(!$authHeader){
                $this->sendResponse( 401,'Unauthorized' );
            }
            
            $this->rawToken = str_replace('Bearer ','',$authHeader);
        }

        private function setCurrentUserData(
           $data
        ){
            $this->currentUserData = $data;
        }

        private function getDataToken(){
            try{
                $service = new GetInfoFromToken( $this->rawToken );

                $this->setCurrentUserData( $service->register() );
            }
            catch(\Exception $error){
                $this->sendResponse( 401,'Unauthorized' );
            }
        }
    }