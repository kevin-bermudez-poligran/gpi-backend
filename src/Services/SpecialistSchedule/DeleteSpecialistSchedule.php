<?php

namespace GpiPoligran\Services\SpecialistSchedule;

use GpiPoligran\Config\SpecialistScheduleStatusEnum;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\SpecialistSchedule;

final class DeleteSpecialistSchedule{
    private int $specialistSchedule;

    public function __construct(
        int $specialistSchedule
    ){
        $this->specialistSchedule = $specialistSchedule;
    }

    public function register(){
        try{
            SpecialistSchedule::where('id',$this->specialistSchedule)->update(['status' => SpecialistScheduleStatusEnum::DELETED]);
            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t create specialist schedule',500);
        }
    }
}