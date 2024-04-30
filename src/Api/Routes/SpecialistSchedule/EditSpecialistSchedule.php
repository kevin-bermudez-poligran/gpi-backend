<?php
    namespace GpiPoligran\Api\Routes\SpecialistSchedule;
    use GpiPoligran\Api\Routes\ManagerRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\SpecialistSchedule\EditSpecialistSchedule as EditSpecialistScheduleService;

     final class EditSpecialistSchedule extends ManagerRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('specialist_schedule')->integer();
            $this->validator->required('start_date')->datetime('Y-m-d H:i:s');
            $this->validator->required('end_date')->datetime('Y-m-d H:i:s');
            
            $result = $this->validator->validateSchema([
                'specialist_schedule'     => $this->request->params->specialist_schedule,
                'start_date' => $this->request->body->start_date,
                'end_date' => $this->request->body->end_date
            ]);
            
            return $result;
        }

        public function run(){
            try{              
                $resultValidation = $this->inputIsValid();
                
                if(!$resultValidation['isValid']){
                    throw new ServiceError($resultValidation['errors']);
                }

                $editSpecialistScheduleService = new EditSpecialistScheduleService(
                    $this->request->params->specialist_schedule,
                    $this->request->body->start_date,
                    $this->request->body->end_date
                );
                $editSpecialistScheduleService->register();

                return $this->sendResponse( 200,'Specialist schedule edited' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }