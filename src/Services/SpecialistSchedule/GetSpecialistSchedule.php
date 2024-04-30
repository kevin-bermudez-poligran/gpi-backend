<?php

namespace GpiPoligran\Services\SpecialistSchedule;
use GpiPoligran\Models\SpecialistSchedule;

final class GetSpecialistSchedule{
    private int $specialist;
    private string $startDate;
    private string $endDate;

    public function __construct(
        int $specialist,
        string $startDate,
        string $endDate
    )
    {
       $this->specialist = $specialist; 
       $this->startDate = $startDate;
       $this->endDate = $endDate;
    }

    public function register(){
        $specialistSchedule = SpecialistSchedule::where('specialist',$this->specialist)
                                    ->where('start_date','<=',$this->startDate)
                                    ->where('end_date','>=',$this->startDate);
     
        $specialistSchedule = $specialistSchedule->get()
                    ->toArray();        
        
        return count($specialistSchedule) ? $specialistSchedule[0] : null;
    }
}