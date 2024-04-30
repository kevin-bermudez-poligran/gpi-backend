<?php
    namespace GpiPoligran\Api\Routes\System;
    use GpiPoligran\Api\Routes\RouteBase;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\System\Install as InstallService;
    // use CommunityFutbolServices\Users\CreateUser\WithClassicAuth as CreateUserService;
    // use CommunityFutbolDtos\Users\CreateUser as CreateUserDTO;

     final class Install extends RouteBase{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('name')->lengthBetween(null,255);
            $this->validator->required('email')->lengthBetween(null,255)->email();
            $this->validator->required('password')->lengthBetween(null,255);
            
            $result = $this->validator->validateSchema([
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
                
                $installService = new InstallService(
                    $this->request->body->name,
                    $this->request->body->email,
                    $this->request->body->password
                );
                $installService->register();

                return $this->sendResponse(201,'Installation ok');
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }