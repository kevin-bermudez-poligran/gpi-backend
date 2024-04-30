<?php
    namespace GpiPoligran\Api\Routes\MedicalOrder;
    use GpiPoligran\Api\Routes\ManagerRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\MedicalOrder\CreateMedicalOrder as CreateMedicalOrderService;

     final class CreateMedicalOrder extends ManagerRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('specialist')->integer();
            $this->validator->required('user')->integer();
            $this->validator->optional('description')->lengthBetween(null,500);
            
            $result = $this->validator->validateSchema([
                'specialist' => $this->request->body->specialist,
                'user' => $this->request->body->user,
                'descrpition'     => $this->request->body->descrpition
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $createMedicalOrderService = new CreateMedicalOrderService(
                    $this->request->body->specialist,
                    $this->request->body->user,
                    $this->request->body->description,
                );
                $createMedicalOrderService->register();

                return $this->sendResponse( 201,'Medical order created' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }