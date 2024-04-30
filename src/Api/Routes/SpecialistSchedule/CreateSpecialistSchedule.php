<?php
    namespace GpiPoligran\Api\Routes\SpecialistSchedule;
    use GpiPoligran\Api\Routes\ManagerRoute;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Services\SpecialistSchedule\CreateSpecialistSchedule as CreateSpecialistScheduleService;

     final class CreateSpecialistSchedule extends ManagerRoute{
        public function __construct($request,$response){
            parent::__construct($request,$response);
        }

        private function inputIsValid(){
            $this->validator->required('specialist')->integer();
            $this->validator->required('start_date')->datetime('Y-m-d H:i:s');
            $this->validator->required('end_date')->datetime('Y-m-d H:i:s');
            
            $result = $this->validator->validateSchema([
                'specialist'     => $this->request->body->specialist,
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

                $createSpecialistScheduleService = new CreateSpecialistScheduleService(
                    $this->request->body->specialist,
                    $this->request->body->start_date,
                    $this->request->body->end_date
                );
                $createSpecialistScheduleService->register();

                return $this->sendResponse( 201,'Specialist schedule created' );
            }
            catch(\Exception $error){
                return $this->handlerException( $error );
            }
        }
    }