<?php

namespace GpiPoligran\Services\MedicalAppointment;
use GpiPoligran\Models\MedicalAppointment;

final class GetMedicalAppointmentBySchedule{
    private int $schedule;

    public function __construct(
        int $schedule
    )
    {
       $this->schedule = $schedule;
    }

    public function register(){
        $medicalAppointment = MedicalAppointment::where('schedule',$this->schedule);
     
        $medicalAppointment = $medicalAppointment->get()
                    ->toArray();        
        
        return count($medicalAppointment) ? $medicalAppointment[0] : null;
    }
}