<?php
    namespace GpiPoligran\Api\Routes\MedicalAppointment;
    use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\MedicalAppointment\CreateMedicalAppointment as CreateMedicalAppointmentService;

     final class CreateMedicalAppointment extends AdminOrSelfUserRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('order')->integer();
            $this->validator->required('schedule')->integer();
            
            $result = $this->validator->validateSchema([
                'order' => $this->request->body->order,
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

                $createMedicalAppointmentService = new CreateMedicalAppointmentService(
                    $this->request->body->order,
                    $this->request->body->schedule
                );
                $createMedicalAppointmentService->register();

                return $this->sendResponse( 201,'Medical appointment created' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }