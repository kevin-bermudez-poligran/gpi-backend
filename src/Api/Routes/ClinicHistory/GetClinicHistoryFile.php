<?php

namespace GpiPoligran\Api\Routes\ClinicHistory;
use GpiPoligran\Api\Routes\AdminOrSelfUserRoute;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\MedicalOrder\GetOrderFile as GetOrderFileService;
use GpiPoligran\Services\ClinicHistory\GetClinicHistoryFile as GetClinicHistoryFileService;

final class GetClinicHistoryFile extends AdminOrSelfUserRoute{
    public function __construct( $req,$res )
    {
        parent::__construct( $req,$res );
    }

    private function inputIsValid(){
        $this->validator->required('user')->integer();
        
        $result = $this->validator->validateSchema([
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

            $createClinicHistoryFileService = new GetClinicHistoryFileService(
                $this->request->query->user
            );

            return $this->sendResponse( 200,'Clini history file',[
                'url_file' => $createClinicHistoryFileService->register()
            ]);
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}