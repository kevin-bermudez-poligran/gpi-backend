<?php

namespace GpiPoligran\Services\MedicalAppointment;
use GpiPoligran\Models\MedicalAppointment;

final class GetMedicalAppointmentById{
    private int $medicalAppointment;

    public function __construct(
        int $medicalAppointment
    )
    {
       $this->medicalAppointment = $medicalAppointment;
    }

    public function register(){
        $medicalAppointment = MedicalAppointment::where('id',$this->medicalAppointment);
     
        $medicalAppointment = $medicalAppointment->get()
                    ->toArray();        
        
        return count($medicalAppointment) ? $medicalAppointment[0] : null;
    }
}