<?php

namespace GpiPoligran\Services\MedicalOrder;
use GpiPoligran\Models\MedicalOrder;
use GpiPoligran\Exceptions\Service as ServiceError;

final class GetMedicalOrdersByUser{
    private int $user;

    public function __construct(
        int $user
    )
    {
       $this->user = $user;
    }

    public function register(){
        try{
            $ordersQuery = MedicalOrder::where('user',$this->user);
     
            $orders = $ordersQuery
                        ->with('specialistData')
                        ->with('userData')
                        ->with('medicalAppointment',function($q){
                            $q->with('scheduleData');
                        })
                        ->get()
                        ->toArray();        
            
            return count($orders) ? $orders : [];
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t list medical orders',500);
        }
    }
}