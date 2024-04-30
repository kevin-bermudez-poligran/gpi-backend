<?php

namespace GpiPoligran\Services\MedicalAppointment;
use GpiPoligran\Models\MedicalAppointment;

final class GetMedicalAppointmentByOrder{
    private int $order;

    public function __construct(
        int $order
    )
    {
       $this->order = $order;
    }

    public function register(){
        $order = MedicalAppointment::where('order',$this->order);
     
        $order = $order->get()
                    ->toArray();        
        
        return count($order) ? $order[0] : null;
    }
}