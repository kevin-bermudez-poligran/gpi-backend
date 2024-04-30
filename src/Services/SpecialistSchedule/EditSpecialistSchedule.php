<?php

namespace GpiPoligran\Services\SpecialistSchedule;
use GpiPoligran\Utils\ValidateDates;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\SpecialistSchedule;
use GpiPoligran\Services\SpecialistSchedule\GetSpecialistSchedule;

final class EditSpecialistSchedule{
    private int $specialistSchedule;
    private string $startDate;
    private string $endDate;

    public function __construct(
        int $specialistSchedule,
        string $startDate,
        string $endDate
    ){
        $this->specialistSchedule = $specialistSchedule;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function register(){
        try{
            if(!ValidateDates::secondGreaterOrEqualThanFirst($this->startDate,$this->endDate)){
                throw new ServiceError( [],'End date must be greater than start date',400 ); 
            }

            $service = new GetSpecialistSchedule(
                0,
                $this->startDate,
                $this->specialistSchedule
            );

            if( $service->register() ){
                throw new ServiceError( [],'This schedule has already been used',400 );
            }
            
            SpecialistSchedule::find($this->specialistSchedule)
                                ->update([
                                    'start_date' => $this->startDate,
                                    'end_date' => $this->endDate
                                ]);
            
            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t create specialist schedule',500);
        }
    }
}