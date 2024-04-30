<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Models\User;
use GpiPoligran\Exceptions\Service as ServiceError;
use GpiPoligran\Utils\ManageHashingText;
use GpiPoligran\Utils\ManageJWT;
use GpiPoligran\Utils\ManageCrypt;

final class CreateToken {
    private string $user;
    private string $password;

    public function __construct(
        string $user,
        string $password
    )
    {
        $this->user = $user;
        $this->password = $password;
    }

    private function launchErrorUserNotFound(){
        throw new ServiceError([],'User not found',401);
    }

    public function register(){
       try{
            $userQuery = User::where('email',$this->user)
                    ->get()
                    ->toArray();

            if(!$userQuery){
            $this->launchErrorUserNotFound();
            }

            $user = $userQuery[0];

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
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new ServiceError([],'Can`t install system',500);
        }
    }
}