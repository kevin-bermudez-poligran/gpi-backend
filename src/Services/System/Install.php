<?php

namespace GpiPoligran\Services\System;
use GpiPoligran\Services\DatabaseAdmin\Migrate;
use GpiPoligran\Services\Users\CreateUser;
use GpiPoligran\Exceptions\Service as ServiceError;

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

            $userService = new CreateUser(
                $this->name,
                $this->email,
                $this->password
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