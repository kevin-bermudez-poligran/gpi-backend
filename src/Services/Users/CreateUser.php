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

final class CreateUser{
    private string $name;
    private string $email;
    private string $rawPassword;
    private int $profile;
    private int $identificationNumber;

    public function __construct(
        string $name,
        string $email,
        string $rawPassword,
        int $profile = ProfilesEnum::PATIENT,
        int $identificationNumber = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->rawPassword = $rawPassword;
        $this->profile = $profile;
        $this->identificationNumber = $identificationNumber;
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

            $userModel->save();
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