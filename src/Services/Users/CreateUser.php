<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Exceptions\{
    Service as ServiceError,
    InternalCodeError
};
use GpiPoligran\Models\User;
use GpiPoligran\Utils\ManageHashingText;

final class CreateUser{
    private string $name;
    private string $email;
    private string $rawPassword;

    public function __construct(
        string $name,
        string $email,
        string $rawPassword
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->rawPassword = $rawPassword;
    }

    public function register(){
        try{
            $userModel = new User();
            $userModel->name = $this->name;
            $userModel->email = $this->email;
            $userModel->password = ManageHashingText::generateHash( $this->rawPassword );

            $userModel->save();
        }
        catch(\Exception $error){
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