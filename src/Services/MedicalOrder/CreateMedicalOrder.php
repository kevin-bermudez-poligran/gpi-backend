<?php

namespace GpiPoligran\Services\MedicalOrder;
use GpiPoligran\Services\Specialists\GetSpecialist;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\MedicalOrder;

final class CreateMedicalOrder{
    private int $specialist;
    private int $user;
    private $description;

    public function __construct(
        int $specialist,
        int $user,
        $description = null
    )
    {
        $this->specialist = $specialist;
        $this->user = $user;
        $this->description = $description;
    }

    public function register(){
        try{
            $service = new GetSpecialist( $this->specialist );

            if( !$service->register() ){
                throw new ServiceError( [],'Specialist not found',400 );
            }

            $order = new MedicalOrder();
            $order->specialist = $this->specialist;
            $order->user = $this->user;
            $order->description = $this->description;
            $order->save();

            return $order->id;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t create medical order',500);
        }
    }
}