<?php
    namespace GpiPoligran\Api\Routes;
    use GpiPoligran\Api\Routes\RouteBase;
    use GpiPoligran\Exceptions\Service as ServiceError;
    // use CommunityFutbolServices\Users\CreateUser\WithClassicAuth as CreateUserService;
    // use CommunityFutbolDtos\Users\CreateUser as CreateUserDTO;

     final class CreateUser extends RouteBase{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('name')->lengthBetween(null,255);
            $this->validator->required('email')->lengthBetween(null,255)->email();
            $this->validator->required('password')->lengthBetween(null,255);
            
            $result = $this->validator->validate([
                'name'     => $this->request->body->name,
                'email'    => $this->request->body->email,
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
                // $userDTO = new CreateUserDTO(
                //     $this->request->body->name,
                //     $this->request->body->userName,
                //     $this->request->body->email,
                //     $this->request->body->password,
                //     $this->request->body->userType
                // );
                
                // $createUserInstance = new CreateUserService($userDTO);
                // $resultService = $createUserInstance->register();

                // if(gettype($resultService) === 'array' && isset($resultService['redirect_url'])){
                //     return self:: sendResponse($this->response,200,'Paid plan',$resultService);
                // }

                return $this->sendResponse(201,'Installation test ok');
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }