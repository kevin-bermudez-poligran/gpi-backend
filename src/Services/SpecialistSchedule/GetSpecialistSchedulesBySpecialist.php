<?php

namespace GpiPoligran\Services\SpecialistSchedule;
use GpiPoligran\Models\SpecialistSchedule;

final class GetSpecialistSchedulesBySpecialist{
    private int $specialist;

    public function __construct(
        int $specialist
    )
    {
       $this->specialist = $specialist;
    }

    public function register(){
        $specialistSchedules = SpecialistSchedule::where('specialist',$this->specialist);
     
        $specialistSchedules = $specialistSchedules->get()
                    ->toArray();        
        
        return count($specialistSchedules) ? $specialistSchedules : null;
    }
}