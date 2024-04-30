<?php

namespace GpiPoligran\Services\Users;

use GpiPoligran\Config\ProfilesEnum;
use GpiPoligran\Config\SpecialistStatusEnum;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Models\{Specialist,User};

final class DeleteSpecialist{
    private int $user;

    public function __construct(
        int $user
    ){
        $this->user = $user;
    }

    public function register(){
        try{
            $data = User::where('id',$this->user)->where('profile',ProfilesEnum::SPECIALIST)->get()->toArray();

            if(!count($data)){
                throw new ServiceError( [],'User is not specialist',400 );
            }

            Specialist::where('specialist',$this->user)->update(['status' => SpecialistStatusEnum::DELETED]);
            return true;
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t delete specialist',500);
        }
    }
}