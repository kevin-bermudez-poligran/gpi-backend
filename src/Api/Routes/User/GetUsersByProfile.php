<?php

namespace GpiPoligran\Api\Routes\User;
use GpiPoligran\Api\Routes\RouteBase;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\Users\GetUsersByProfile as GetUsersByProfileService;

final class GetUsersByProfile extends RouteBase{
    public function __construct( $req,$res )
    {
        parent::__construct( $req,$res );
    }

    private function inputIsValid(){
        $this->validator->required('profile')->integer();
        
        $result = $this->validator->validateSchema([
            'profile' => $this->request->params->profile
        ]);
        
        return $result;
    }

    public function run(){
        try{              
            $resultValidation = $this->inputIsValid();
            
            if(!$resultValidation['isValid']){
                throw new ServiceError($resultValidation['errors']);
            }

            $createMedicalOrderService = new GetUsersByProfileService();

            return $this->sendResponse( 200,'Users',$createMedicalOrderService->register( $this->request->params->profile ));
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}