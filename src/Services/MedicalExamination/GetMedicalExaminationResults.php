<?php

namespace GpiPoligran\Services\MedicalExamination;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\MedicalExamination;

final class GetMedicalExaminationResults{
    private int $user;

    public function __construct(
        int $user
    )
    {
        $this->user = $user;
    }

    public function register(){
        try{
            $medicalExaminationQuery = MedicalExamination::where('user',$this->user);
     
            $orders = $medicalExaminationQuery
                        ->get()
                        ->toArray();        
            
            return count($orders) ? $orders : [];
        }
        catch(\Exception $error){
            print_r($error);
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t get medical examination results',500);
        }
    }
}