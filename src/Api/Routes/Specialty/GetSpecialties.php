<?php

namespace GpiPoligran\Api\Routes\Specialty;
use GpiPoligran\Api\Routes\RouteBase;
use GpiPoligran\Services\Specialties\GetSpecialties as GetSpecialtiesService;

final class GetSpecialties extends RouteBase{
    public function __construct( $req,$res )
    {
        parent::__construct( $req,$res );
    }

    public function run(){
        try{
            $getSpecialtiesServices = new GetSpecialtiesService();

            return $this->sendResponse( 200,'Specialties',$getSpecialtiesServices->register());
        }
        catch(\Exception $error){
            return $this->handlerException( $error );
        }
    }
}