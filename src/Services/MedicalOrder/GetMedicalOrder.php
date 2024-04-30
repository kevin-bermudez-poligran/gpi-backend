<?php

namespace GpiPoligran\Services\MedicalOrder;
use GpiPoligran\Models\MedicalOrder;

final class GetMedicalOrder{
    private int $order;

    public function __construct(
        int $order
    )
    {
       $this->order = $order;
    }

    public function register(){
        $order = MedicalOrder::where('id',$this->order);
     
        $order = $order
                    ->with('specialistData',function($q){
                        $q->with('specialistData');
                    })
                    ->with('userData')
                    ->get()
                    ->toArray();        
        
        return count($order) ? $order[0] : null;
    }
}