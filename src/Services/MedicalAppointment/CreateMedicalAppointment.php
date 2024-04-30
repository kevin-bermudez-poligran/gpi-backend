<?php

namespace GpiPoligran\Services\MedicalAppointment;

use GpiPoligran\Config\SpecialistScheduleStatusEnum;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\MedicalAppointment;
use GpiPoligran\Services\MedicalOrder\GetMedicalOrder;
use GpiPoligran\Services\SpecialistSchedule\GetSpecialistScheduleByStatus;
use GpiPoligran\Services\MedicalAppointment\GetMedicalAppointmentByOrder;

final class CreateMedicalAppointment{
    private int $order;
    private int $schedule;

    public function __construct(
        int $order,
        int $schedule
    )
    {
        $this->order = $order;
        $this->schedule = $schedule;
    }

    public function register(){
        try{
            $serviceMedicalOrder = new GetMedicalOrder( $this->order );

            if( !$serviceMedicalOrder->register() ){
                throw new ServiceError( [],'Medical order not found',400 );
            }

            $specialistScheduleService = new GetSpecialistScheduleByStatus( $this->schedule,SpecialistScheduleStatusEnum::AVAILABLE );

            if( !$specialistScheduleService->register() ){
                throw new ServiceError( [],'Specialist schedule is not available',400 );
            }

            $getMedicalAppointmentService = new GetMedicalAppointmentByOrder( $this->order );

            if( $getMedicalAppointmentService->register() ){
                throw new ServiceError( [],'Order has been already scheduled',400 );
            }

            $order = new MedicalAppointment();
            $order->order = $this->order;
            $order->schedule = $this->schedule;
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