<?php
    namespace GpiPoligran\Api\Routes\Specialty;
    use GpiPoligran\Api\Routes\SuperAdminRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\Specialties\CreateSpecialty as CreateSpecialtyService;

     final class CreateSpecialty extends SuperAdminRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('name')->lengthBetween(null,255);
            
            $result = $this->validator->validateSchema([
                'name'     => $this->request->body->name
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $createUserService = new CreateSpecialtyService(
                    $this->request->body->name
                );
                $createUserService->register();

                return $this->sendResponse( 201,'Specialty created' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }