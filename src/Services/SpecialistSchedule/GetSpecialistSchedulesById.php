<?php

namespace GpiPoligran\Services\SpecialistSchedule;

use GpiPoligran\Models\SpecialistSchedule;

final class GetSpecialistSchedulesById{
    private int $id;

    public function __construct(
        int $id
    )
    {
       $this->id = $id;
    }

    public function register(){
        $specialistSchedules = SpecialistSchedule::where('id',$this->id);
     
        $specialistSchedules = $specialistSchedules->get()
                    ->toArray();        
        
        return count($specialistSchedules) ? $specialistSchedules[0] : null;
    }
}