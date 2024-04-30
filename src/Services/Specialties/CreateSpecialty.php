<?php

namespace GpiPoligran\Services\Specialties;
use GpiPoligran\Models\Specialty;
use GpiPoligran\Exceptions\Service as ServiceError;

final class CreateSpecialty{
    private string $specialty;

    public function __construct( string $name ){
        $this->specialty = $name;
    }

    public function register(){
        try{
            $newSpecialty = new Specialty();
            $newSpecialty->name = $this->specialty;
            $newSpecialty->save();

            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t create specialty',500);
        }
    }
} 