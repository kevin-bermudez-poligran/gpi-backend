<?php
    namespace GpiPoligran\Api\Routes;
    use GpiPoligran\Api\Routes\RoutePrivate;
    use GpiPoligran\Config\ProfilesEnum;

    class AdminOrSelfUserRoute extends RoutePrivate {
        protected $dataToken;
        protected $decryptDataToken;

        public function __construct($request,$response){
            parent::__construct($request,$response);

            if(!isset($this->currentUserData['profile']) || (
                $this->currentUserData['profile'] > ProfilesEnum::SUPER_ADMIN
                &&
                $this->currentUserData['id'] !== $this->request->body->user
            )){
                $this->sendResponse( 401,'Unauthorized' );
            }
        }
    }