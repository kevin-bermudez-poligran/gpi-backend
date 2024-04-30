<?php
    namespace GpiPoligran\Api\Routes\MedicalOrder;
    use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\MedicalOrder\GetMedicalOrdersByUser as GetMedicalOrdersService;

     final class GetMedicalOrders extends AdminOrSelfUserRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('user')->integer();
            
            $result = $this->validator->validateSchema([
                'user' => $this->request->query->user
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $createMedicalOrderService = new GetMedicalOrdersService(
                    $this->request->query->user
                );

                return $this->sendResponse( 201,'Medical orders list',$createMedicalOrderService->register() );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }