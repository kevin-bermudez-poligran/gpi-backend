<?php

namespace GpiPoligran\Services\System;
use GpiPoligran\Services\DatabaseAdmin\Migrate;
use GpiPoligran\Services\Users\CreateUser;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Config\ProfilesEnum;
use GpiPoligran\Services\Users\GetUsers;

final class Install{
    private string $name;
    private string $email;
    private string $password;

    public function __construct(
        string $name,
        string $email,
        string $password
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function register(){
        try{
            $databaseService = new Migrate();
            $databaseService->register();

            $getUsersService = new GetUsers();
            $usersList = $getUsersService->register();

            if( count($usersList) ){
                throw new ServiceError([],'System is already installed');
            }

            $userService = new CreateUser(
                $this->name,
                $this->email,
                $this->password,
                ProfilesEnum::SUPER_ADMIN
            );
            $userService->register();
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t install system',500);
        }
    }
}