<?php

namespace GpiPoligran\Services\MedicalOrder;
use GpiPoligran\Models\MedicalOrder;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\MedicalOrder\GetMedicalOrder;
use GpiPoligran\Utils\HandleFiles;

final class GetOrderFile{
    private int $order;

    public function __construct(
        int $order
    )
    {
       $this->order = $order;
    }

    public function register(){
        try{
            $medicalOrderService = new GetMedicalOrder( $this->order );
            $data = $medicalOrderService->register();

            $pathNewFile = HandleFiles::createFile( "orders",$this->order.".txt",[
                'Número '. $data['id'],
                'Especialista '.$data['specialist_data']['specialist_data']['name']
            ] );  
            
            return $pathNewFile;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t list medical orders',500);
        }
    }
}