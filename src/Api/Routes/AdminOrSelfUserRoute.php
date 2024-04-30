<?php
    namespace GpiPoligran\Api\Routes;
    use GpiPoligran\Api\Routes\RoutePrivate;
    use GpiPoligran\Config\ProfilesEnum;

    class AdminOrSelfUserRoute extends RoutePrivate {
        protected $dataToken;
        protected $decryptDataToken;

        public function __construct($request,$response){
            parent::__construct($request,$response);

            $userId = isset($this->request->body) && isset($this->request->body->user) ? $this->request->body->user : $this->request->query->user;

            if(!isset($this->currentUserData['profile']) || (
                $this->currentUserData['profile'] > ProfilesEnum::SUPER_ADMIN
                &&
                $this->currentUserData['id'] !== $userId
            )){
                echo "Por unauthorized";
                $this->sendResponse( 401,'Unauthorized' );
            }
        }
    }