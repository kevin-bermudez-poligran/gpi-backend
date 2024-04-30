<?php
    namespace GpiPoligran\Api\Routes\ClinicHistory;
    use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\ClinicHistory\GetClinicHistory as GetClinicHistoryService;

     final class GetClinicHistory extends AdminOrSelfUserRoute{
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

                $clinicHistoryService = new GetClinicHistoryService(
                    $this->request->query->user
                );

                return $this->sendResponse( 200,'Clinic history',$clinicHistoryService->register() );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }