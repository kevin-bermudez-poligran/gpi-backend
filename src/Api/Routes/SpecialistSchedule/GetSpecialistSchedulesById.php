<?php

namespace GpiPoligran\Api\Routes\SpecialistSchedule;
use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\SpecialistSchedule\GetSpecialistSchedulesById as GetSpecialistSchedulesByIdService;

final class GetSpecialistSchedulesById extends AdminOrSelfUserRoute{
    public function __construct( $req,$res )
    {
        parent::__construct( $req,$res );
    }

    private function inputIsValid(){
        $this->validator->required('id')->integer();
        
        $result = $this->validator->validateSchema([
            'id' => $this->request->params->id
        ]);
        
        return $result;
    }

    public function run(){
        try{              
            $resultValidation = $this->inputIsValid();
            
            if(!$resultValidation['isValid']){
                throw new ServiceError($resultValidation['errors']);
            }

            $createMedicalOrderService = new GetSpecialistSchedulesByIdService( $this->request->params->id );
            $data = $createMedicalOrderService->register();

            return $this->sendResponse( 200,'Specialist schedules',$data ? $data : [] );
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}