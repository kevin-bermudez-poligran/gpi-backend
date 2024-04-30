<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Exceptions\{
    Service as ServiceError,
    InternalCodeError
};
use GpiPoligran\Services\Users\GetUser;
use GpiPoligran\Models\User;
use GpiPoligran\Utils\ManageHashingText;
use GpiPoligran\Config\ProfilesEnum;
use GpiPoligran\Services\Specialists\CreateSpecialist;
use GpiPoligran\Services\Specialties\GetSpecialty;

final class CreateUser{
    private string $name;
    private string $email;
    private string $rawPassword;
    private int $profile;
    private $identificationNumber;
    private array $additional;

    public function __construct(
        string $name,
        string $email,
        string $rawPassword,
        int $profile = ProfilesEnum::PATIENT,
        $identificationNumber = null,
        $additional = []
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->rawPassword = $rawPassword;
        $this->profile = $profile;
        $this->identificationNumber = $identificationNumber;
        $this->additional = $additional;
    }

    public function register(){
        try{
            if($this->identificationNumber !== null){
                $this->profile = ProfilesEnum::PATIENT;
                $this->rawPassword = $this->identificationNumber;
            }

            $userService = new GetUser( $this->email );
            $user = $userService->register();

            if($user){
                throw new ServiceError([],'User already exists',400);
            }

            $userModel = new User();
            $userModel->name = $this->name;
            $userModel->email = $this->email;
            $userModel->password = ManageHashingText::generateHash( $this->rawPassword );
            $userModel->profile = $this->profile;

            if($this->identificationNumber !== null){
                $userModel->identification_number = $this->identificationNumber;
            }

            if($this->profile === ProfilesEnum::SPECIALIST){
                $specialtyService = new GetSpecialty( $this->additional['specialty'] );
            
                if(!$specialtyService->register()){
                    throw new ServiceError([],'Specialty not found',400);
                }
            }

            $userModel->save();

            if($this->profile === ProfilesEnum::SPECIALIST){
                $specialistService = new CreateSpecialist( $userModel->id,$this->additional['specialty'] );
                $specialistService->register();
            }
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError( [],'Can`t create user',500,new InternalCodeError(
                InternalCodeError::CODES['USER']['name'],
                InternalCodeError::CODES['USER']['codes']['FAIL_CREATE_USER'],
                [
                    'error_detail' => $error
                ]
            ) );
        }
    }
}