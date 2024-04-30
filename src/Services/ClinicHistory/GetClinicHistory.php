<?php

namespace GpiPoligran\Services\ClinicHistory;
use GpiPoligran\Services\MedicalOrder\GetMedicalOrdersByUser;
use GpiPoligran\services\MedicalAppointment\GetMedicalAppointmentByOrder;
use GpiPoligran\Exceptions\Service as ServiceError;

final class GetClinicHistory{
    private int $user;

    public function __construct( 
        int $user
    )
    {
        $this->user = $user;
    }

    public function register(){
        try{
            $service = new GetMedicalOrdersByUser( $this->user );
            $orders = $service->register();

            if( !count($orders) ){
                throw new ServiceError( [],'Clinic history not found',404 );
            }

            return $orders;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t get clinic history',500);
        }
    }
}