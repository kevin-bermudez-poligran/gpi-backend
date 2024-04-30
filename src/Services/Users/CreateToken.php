<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Models\User;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Utils\ManageHashingText;
use GpiPoligran\Utils\ManageJWT;
use GpiPoligran\Utils\ManageCrypt;
use GpiPoligran\Services\Users\GetUser;

final class CreateToken {
    private $user;
    private string $password;

    public function __construct(
        $user,
        string $password
    )
    {
        $this->user = $user;
        $this->password = $password;
    }

    private function launchErrorUserNotFound(){
        throw new ServiceError([],'User not found',400);
    }

    public function register(){
       try{
            $userService = new GetUser( $this->user );
            $user = $userService->register();

            if(!$user){
                $this->launchErrorUserNotFound();
            }

            if(!ManageHashingText::verifyHash($this->password,$user['password'])){
                $this->launchErrorUserNotFound();
            }

            $token = ManageJWT::create(array(
            'auth' => ManageCrypt::encrypt(
                array(
                    'id'         => $user['id'],
                    'name'       => $user['name'],
                    'profile' => $user['profile'],
                    'email' => $user['email']
                )),
            'id'         => $user['id'],
            'name'       => $user['name'],
            'profile' => $user['profile'],
            'email' => $user['email'],
            ),($_ENV['HOURS_EXPIRED_TOKEN'] * 60 * 60));

            return $token;
       }
        catch(\Exception $error){
            // print_r($error);
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t login user',500);
        }
    }
}