<?php

namespace GpiPoligran\Services\Specialists;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\Specialist;
use GpiPoligran\Services\Specialties\GetSpecialty;

final class CreateSpecialist{
    private int $specialist;
    private int $specialty;

    public function __construct( int $specialist,int $specialty ){
        $this->specialist = $specialist;
        $this->specialty = $specialty;    
    }

    public function register(){
        try{
            $specialtyService = new GetSpecialty( $this->specialty );
            
            if(!$specialtyService->register()){
                throw new ServiceError([],'Specialty not found',400);
            }

            $newSpecialty = new Specialist();
            $newSpecialty->specialist = $this->specialist;
            $newSpecialty->specialty = $this->specialty;

            $newSpecialty->save();

            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t create specialist',500);
        }
    }
} 