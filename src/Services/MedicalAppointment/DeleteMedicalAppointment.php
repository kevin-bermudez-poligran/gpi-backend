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

final class DeleteMedicalAppointment{
    private int $medicalAppointment;

    public function __construct(
        int $medicalAppointment
    )
    {
        $this->medicalAppointment = $medicalAppointment;
    }

    public function register(){
        try{
            $getMedicalAppointmentService = new GetMedicalAppointmentById( $this->medicalAppointment );
            $data = $getMedicalAppointmentService->register();

            MedicalAppointment::where('id',$this->medicalAppointment)->delete();
            SpecialistSchedule::where('id',$data['schedule'])->update(['status' => SpecialistScheduleStatusEnum::AVAILABLE]);

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