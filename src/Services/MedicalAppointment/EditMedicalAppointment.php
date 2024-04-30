<?php

namespace GpiPoligran\Services\MedicalAppointment;

use GpiPoligran\Config\SpecialistScheduleStatusEnum;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\{
    MedicalAppointment,
    SpecialistSchedule
};
use GpiPoligran\Services\SpecialistSchedule\GetSpecialistScheduleByStatus;
use GpiPoligran\Services\MedicalAppointment\GetMedicalAppointmentById;

final class EditMedicalAppointment{
    private int $medicalAppointment;
    private int $schedule;

    public function __construct(
        int $medicalAppointment,
        int $schedule
    )
    {
        $this->medicalAppointment = $medicalAppointment;
        $this->schedule = $schedule;
    }

    public function register(){
        try{
            $specialistScheduleService = new GetSpecialistScheduleByStatus( $this->schedule,SpecialistScheduleStatusEnum::AVAILABLE );

            if( !$specialistScheduleService->register() ){
                throw new ServiceError( [],'Specialist schedule is not available',400 );
            }

            $getMedicalAppointmentService = new GetMedicalAppointmentById( $this->medicalAppointment );
            $data = $getMedicalAppointmentService->register();

            if(!$data){
                throw new ServiceError( [],'Medical appointment not found',400 );
            }

            SpecialistSchedule::where('id',$data['schedule'])->update(['status' => SpecialistScheduleStatusEnum::AVAILABLE]);
            
            MedicalAppointment::where('id',$this->medicalAppointment)
            ->update(['schedule' => $this->schedule]);
            
            SpecialistSchedule::where('id',$this->schedule)->update(['status' => SpecialistScheduleStatusEnum::USED]);
            
            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t update medical appointment',500);
        }
    }
}