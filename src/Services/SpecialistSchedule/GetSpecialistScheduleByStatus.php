<?php

namespace GpiPoligran\Services\SpecialistSchedule;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\SpecialistSchedule;

final class GetSpecialistScheduleByStatus{
    private int $specialistSchedule;
    private string $status;

    public function __construct(
        int $specialistSchedule,
        string $status
    ){
        $this->specialistSchedule = $specialistSchedule;
        $this->status = $status;
    }

    public function register(){
        try{
            $specialistSchedule = SpecialistSchedule::where('id',$this->specialistSchedule)
                                ->where('status',$this->status)
                                ->get()
                                ->toArray();
            
            return count($specialistSchedule) ? $specialistSchedule[0] : null;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t get specialist schedule by status',500);
        }
    }
}