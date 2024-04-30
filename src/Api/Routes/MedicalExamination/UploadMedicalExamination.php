<?php
namespace GpiPoligran\Api\Routes\MedicalExamination;
use GpiPoligran\Services\MedicalExamination\UploadMedicalExamination as UploadMedicalExaminationService;
use GpiPoligran\Api\Routes\SpecialistRoute;

final class UploadMedicalExamination extends SpecialistRoute{

    public function __construct($request,$response){
        parent::__construct($request,$response);
        $this->request   = $request;
        $this->response  = $response;
    }

    public function run(){
        try{

            $service = new UploadMedicalExaminationService(
                $this->currentUserData['id']
            );
            $service->register(); 
            
            $this->sendResponse( 200, 'Medical examination uploaded' );
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}