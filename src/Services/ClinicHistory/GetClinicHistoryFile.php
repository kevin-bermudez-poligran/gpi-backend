<?php

namespace GpiPoligran\Services\ClinicHistory;
use GpiPoligran\Models\MedicalOrder;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Services\ClinicHistory\GetClinicHistory;
use GpiPoligran\Utils\HandleFiles;

final class GetClinicHistoryFile{
    private int $user;

    public function __construct(
        int $user
    )
    {
       $this->user = $user;
    }

    public function register(){
        try{
            $medicalOrderService = new GetClinicHistory( $this->user );
            $data = $medicalOrderService->register();

            $content = ['Órdenes'];

            $content[] = 'Usuario: ' . $data[0]['user_data']['name'] . ' - ' . $data[0]['user_data']['identification_number'];

            foreach($data as $order){
                $content[] = 'Número: '.$order['id'];
                $content[] = 'Especialista: '.$order['specialist_data']['specialist_data']['name'];

                if( $order['medical_appointment'] ){
                    $content[] = 'Cita: '.$order['medical_appointment']['id'] . ' de: '.$order['medical_appointment']['schedule_data']['start_date'] . ' a ' .$order['medical_appointment']['schedule_data']['end_date'];
                }
            }
            
            $pathNewFile = HandleFiles::createFile( "clinic-histories",$this->user.".txt",$content );  
            
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