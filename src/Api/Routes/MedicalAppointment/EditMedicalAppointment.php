<?php
    namespace GpiPoligran\Api\Routes\MedicalAppointment;
    use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\MedicalAppointment\EditMedicalAppointment as EditMedicalAppointmentService;

     final class EditMedicalAppointment extends AdminOrSelfUserRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('medical_appointment')->integer();
            $this->validator->required('schedule')->integer();
            
            $result = $this->validator->validateSchema([
                'medical_appointment' => $this->request->params->medical_appointment,
                'schedule' => $this->request->body->schedule
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $editMedicalAppointmentService = new EditMedicalAppointmentService(
                    $this->request->params->medical_appointment,
                    $this->request->body->schedule
                );
                $editMedicalAppointmentService->register();

                return $this->sendResponse( 200,'Medical appointment updated' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }