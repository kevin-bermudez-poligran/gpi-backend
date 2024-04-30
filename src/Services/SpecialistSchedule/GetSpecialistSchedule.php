<?php

namespace GpiPoligran\Services\SpecialistSchedule;
use GpiPoligran\Models\SpecialistSchedule;

final class GetSpecialistSchedule{
    private int $specialist;
    private string $startDate;
    private int $id;

    public function __construct(
        int $specialist = 0,
        string $startDate = '',
        int $id = 0
    )
    {
       $this->specialist = $specialist; 
       $this->startDate = $startDate;
       $this->id = $id;
    }

    public function register(){
        if($this->id){
            $specialistSchedule = SpecialistSchedule::where('id','!=',$this->id);
        }
        else{
            $specialistSchedule = SpecialistSchedule::where('specialist',$this->specialist);
        }
                                    
        if(strlen($this->startDate)){
            $specialistSchedule = $specialistSchedule->where('start_date','<=',$this->startDate)
                                                    ->where('end_date','>=',$this->startDate);
        }
        
     
        $specialistSchedule = $specialistSchedule->get()
                    ->toArray();        
        
        return count($specialistSchedule) ? $specialistSchedule[0] : null;
    }
}