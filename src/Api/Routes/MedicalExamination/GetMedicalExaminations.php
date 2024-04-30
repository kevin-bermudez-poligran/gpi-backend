<?php
    namespace GpiPoligran\Api\Routes\MedicalExamination;
    use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\MedicalExamination\GetMedicalExaminationResults as GetMedicalExaminationResultsService;

     final class GetMedicalExaminations extends AdminOrSelfUserRoute{
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

                $createMedicalOrderService = new GetMedicalExaminationResultsService(
                    $this->request->query->user
                );

                return $this->sendResponse( 201,'Medical examinations list',$createMedicalOrderService->register() );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }