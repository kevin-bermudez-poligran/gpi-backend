<?php
    namespace GpiPoligran\Api\Routes\MedicalAppointment;
    use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\MedicalAppointment\DeleteMedicalAppointment as DeleteMedicalAppointmentService;

     final class DeleteMedicalAppointment extends AdminOrSelfUserRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('medical_appointment')->integer();
            
            $result = $this->validator->validateSchema([
                'medical_appointment' => $this->request->params->medical_appointment
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $editMedicalAppointmentService = new DeleteMedicalAppointmentService(
                    $this->request->params->medical_appointment
                );
                $editMedicalAppointmentService->register();

                return $this->sendResponse( 200,'Medical appointment deleted' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }