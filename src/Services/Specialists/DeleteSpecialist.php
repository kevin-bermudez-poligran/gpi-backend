<?php

namespace GpiPoligran\Services\Specialists;

use GpiPoligran\Models\Specialist;
// use GpiPoligran\Services\SpecialistSchedule\GetSpecialistSchedulesBySpecialist;
use GpiPoligran\Exceptions\Service as ServiceError;

final class DeleteSpecialist{
    private int $specialist;

    public function __construct(
        int $specialist
    )
    {
        $this->specialist = $specialist;
    }

    public function register(){
        try{
            // $service = new GetSpecialistSchedulesBySpecialist( $this->specialist );

            // if($service->register()){
            //     throw new ServiceError( [],'Cannot delete specialists with assigned schedules');
            // }
            echo $this->specialist;
            Specialist::find( $this->specialist )->delete();
            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t delete specialist',500);
        }
    }
}