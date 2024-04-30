<?php

namespace GpiPoligran\Api\Routes\MedicalOrder;
use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\MedicalOrder\GetOrderFile as GetOrderFileService;

final class GetOrderFile extends AdminOrSelfUserRoute{
    public function __construct( $req,$res )
    {
        parent::__construct( $req,$res );
    }

    private function inputIsValid(){
        $this->validator->required('order')->integer();
        $this->validator->required('user')->integer();
        
        $result = $this->validator->validateSchema([
            'order' => $this->request->params->order,
            'user' => $this->request->query->user
        ]);
        
        return $result;
    }

    public function run(){
        try{              
            $resultValidation = $this->inputIsValid();
            
            if(!$resultValidation['isValid']){
                throw new ServiceError($resultValidation['errors']);
            }

            $createMedicalOrderService = new GetOrderFileService(
                $this->request->params->order
            );

            return $this->sendResponse( 200,'Medical orders list',[
                'url_file' => $createMedicalOrderService->register()
            ]);
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}