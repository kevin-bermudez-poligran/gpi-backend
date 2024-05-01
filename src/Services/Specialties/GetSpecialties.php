<?php

namespace GpiPoligran\Services\Specialties;
use GpiPoligran\Models\Specialty;
use GpiPoligran\Exceptions\Service as ServiceError;

final class GetSpecialties{
    public function register(){
        try{
            return Specialty::select('*')
                    ->get()
                    ->toArray();
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError( [],'Can`t get specialties',500 );
        }
    }
}