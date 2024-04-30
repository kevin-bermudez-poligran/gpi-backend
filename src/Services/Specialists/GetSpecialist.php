<?php

namespace GpiPoligran\Services\Specialists;
use GpiPoligran\Models\SpecialistSchedule;

final class GetSpecialist{
    private int $specialist;

    public function __construct(
        int $specialist
    )
    {
       $this->specialist = $specialist;
    }

    public function register(){
        $specialist = SpecialistSchedule::where('id',$this->specialist);
     
        $specialist = $specialist->get()
                    ->toArray();        
        
        return count($specialist) ? $specialist[0] : null;
    }
}