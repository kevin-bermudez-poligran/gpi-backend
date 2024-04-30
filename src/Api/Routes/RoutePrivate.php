<?php
    namespace GpiPoligran\Api\Routes;
    use GpiPoligran\Api\Routes\RouteBase;
    use GpiPoligran\Utils\ManageJWT;
    use GpiPoligran\Utils\ManageCrypt;

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
            $profile,
            $userProfileId,
            $userId,
            $userType,
            $isExternalIntegration = false
        ){
            $this->currentUserData = [
                'profile' => $profile,
                'user' => $userProfileId,
                'user_id' => $userId,
                'user_type' => $userType,
                'is_external_integration' => $isExternalIntegration
            ];
        }

        private function getDataToken(){
            try{
                $tokenDecode = ManageJWT::decode($this->rawToken);
                $tokenDecode['data']->auth = ManageCrypt::decrypt($tokenDecode['data']->auth);

                $this->setCurrentUserData(
                    $tokenDecode['data']->auth['profile'],
                    $tokenDecode['data']->auth['user'],
                    $tokenDecode['data']->auth['user_id'],
                    $tokenDecode['data']->auth['user_type']
                );
            }
            catch(\Exception $error){
                $this->sendResponse( 401,'Unauthorized' );
            }
        }
    }