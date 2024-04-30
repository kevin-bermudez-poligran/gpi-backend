<?php
    namespace GpiPoligran\Api\Routes\User;
    use GpiPoligran\Api\Routes\SuperAdminRoute;
    use GpiPoligran\Config\ProfilesEnum;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\Users\CreateUser;

     final class CreateSpecialist extends SuperAdminRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('name')->lengthBetween(null,255);
            $this->validator->required('email')->lengthBetween(null,255)->email();
            $this->validator->required('password')->lengthBetween(null,255);
            $this->validator->required('specialty')->integer();
            
            $result = $this->validator->validateSchema([
                'name'     => $this->request->body->name,
                'email'    => $this->request->body->email,
                'password' => $this->request->body->password,
                'specialty' => $this->request->body->specialty
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $createUserService = new CreateUser(
                    $this->request->body->name,
                    $this->request->body->email,
                    $this->request->body->password,
                    ProfilesEnum::SPECIALIST,
                    null,
                    [
                        'specialty' => $this->request->body->specialty
                    ]
                );
                $createUserService->register();

                return $this->sendResponse( 201,'Specialist created' );
            }
            catch(\Exception $error){
                // print_r($error);
                return $this->handlerException( $error );
            }
        }
    }