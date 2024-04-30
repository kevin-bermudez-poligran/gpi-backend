<?php
    namespace GpiPoligran\Api\Routes\User;
    use GpiPoligran\Api\Routes\RouteBase;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\Users\CreateToken as CreateTokenService;

    class CreateToken extends RouteBase{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('user')->lengthBetween(null,255);
            $this->validator->required('password')->lengthBetween(null,255);
            
            $result = $this->validator->validateSchema([
                'user'     => $this->request->body->user,
                'password' => $this->request->body->password
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $service = new CreateTokenService(
                    $this->request->body->user,
                    $this->request->body->password
                );
                $token = $service->register();

                return $this->sendResponse(200,'Token created',[
                    'token' => $token
                ]);
            }
            catch(\Exception $error){
                return RouteBase::handlerException($this->response,$error);
            }
        }
    }