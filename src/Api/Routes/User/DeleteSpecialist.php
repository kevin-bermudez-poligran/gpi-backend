<?php

namespace GpiPoligran\Api\Routes\User;
use GpiPoligran\Api\Routes\SuperAdminRoute;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\Users\DeleteSpecialist as DeleteSpecialistService;

    final class DeleteSpecialist extends SuperAdminRoute{
    public function __construct($request,$response){
        parent::__construct($request,$response);
    }

    private function inputIsValid(){
        $this->validator->required('user')->integer();
        
        $result = $this->validator->validateSchema([
            'user' => $this->request->params->user
        ]);
        
        return $result;
    }

    public function run(){
        try{              
            $resultValidation = $this->inputIsValid();
            
            if(!$resultValidation['isValid']){
                throw new ServiceError($resultValidation['errors']);
            }

            $editMedicalAppointmentService = new DeleteSpecialistService(
                $this->request->params->user
            );
            $editMedicalAppointmentService->register();

            return $this->sendResponse( 200,'Specialist deleted' );
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}