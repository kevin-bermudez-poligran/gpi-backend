<?php

namespace GpiPoligran\Api\Routes\SpecialistSchedule;
use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\SpecialistSchedule\GetSpecialistSchedulesBySpecialist as GetSpecialistSchedulesBySpecialistService;

final class GetSpecialistSchedulesBySpecialist extends AdminOrSelfUserRoute{
    public function __construct( $req,$res )
    {
        parent::__construct( $req,$res );
    }

    private function inputIsValid(){
        $this->validator->required('specialist')->integer();
        
        $result = $this->validator->validateSchema([
            'specialist' => $this->request->params->specialist
        ]);
        
        return $result;
    }

    public function run(){
        try{              
            $resultValidation = $this->inputIsValid();
            
            if(!$resultValidation['isValid']){
                throw new ServiceError($resultValidation['errors']);
            }

            $createMedicalOrderService = new GetSpecialistSchedulesBySpecialistService( $this->request->params->specialist );
            $data = $createMedicalOrderService->register();

            return $this->sendResponse( 200,'Specialist schedules',$data ? $data : [] );
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}