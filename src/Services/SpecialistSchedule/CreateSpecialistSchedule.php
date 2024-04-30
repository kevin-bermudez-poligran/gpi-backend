<?php

namespace GpiPoligran\Services\SpecialistSchedule;
use GpiPoligran\Utils\ValidateDates;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\SpecialistSchedule;
use GpiPoligran\Services\SpecialistSchedule\GetSpecialistSchedule;

final class CreateSpecialistSchedule{
    private int $specialist;
    private string $startDate;
    private string $endDate;

    public function __construct(
        int $specialist,
        string $startDate,
        string $endDate
    ){
        $this->specialist = $specialist;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function register(){
        try{
            if(!ValidateDates::secondGreaterOrEqualThanFirst($this->startDate,$this->endDate)){
                throw new ServiceError( [],'End date must be greater than start date',400 ); 
            }

            $service = new GetSpecialistSchedule(
                $this->specialist,
                $this->startDate,
                $this->endDate
            );

            if( $service->register() ){
                throw new ServiceError( [],'This schedule has already been used',400 );
            }
    
            $specialistSchedule = new SpecialistSchedule();
            $specialistSchedule->specialist = $this->specialist;
            $specialistSchedule->start_date = $this->startDate;
            $specialistSchedule->end_date = $this->endDate;
    
            $specialistSchedule->save();
    
            return $specialistSchedule->id;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t create specialist schedule',500);
        }
    }
}