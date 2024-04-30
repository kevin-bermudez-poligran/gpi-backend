<?php

namespace GpiPoligran\Api\Routes\SpecialistSchedule;
use GpiPoligran\Api\Routes\ManagerRoute;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\SpecialistSchedule\DeleteSpecialistSchedule as DeleteSpecialistScheduleService;

    final class DeleteSpecialistSchedule extends ManagerRoute{
    public function __construct($request,$response){
        parent::__construct($request,$response);
    }

    private function inputIsValid(){
        $this->validator->required('specialist_schedule')->integer();
        
        $result = $this->validator->validateSchema([
            'specialist_schedule'     => $this->request->params->specialist_schedule
        ]);
        
        return $result;
    }

    public function run(){
        try{              
            $resultValidation = $this->inputIsValid();
            
            if(!$resultValidation['isValid']){
                throw new ServiceError($resultValidation['errors']);
            }

            $editSpecialistScheduleService = new DeleteSpecialistScheduleService(
                $this->request->params->specialist_schedule
            );
            $editSpecialistScheduleService->register();

            return $this->sendResponse( 200,'Specialist schedule deleted' );
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}