<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Utils\ManageJWT;
use GpiPoligran\Utils\ManageCrypt;
use GpiPoligran\Exceptions\Service as ServiceError;

final class GetInfoFromToken{
    private string $rawToken;

    public function __construct(string $rawToken)
    {
        $this->rawToken = $rawToken;    
    }

    public function register(){
        try{
            $tokenDecode = ManageJWT::decode( $this->rawToken );
            $tokenDecode['data']->auth = ManageCrypt::decrypt($tokenDecode['data']->auth);

            return [
                'id' => $tokenDecode['data']->auth['id'],
                'name' => $tokenDecode['data']->auth['name'],
                'profile' => $tokenDecode['data']->auth['profile'],
                'email' => $tokenDecode['data']->auth['email']
            ];
        }
        catch(\Exception $error){
            if($error instanceof ServiceError){
                throw $error;
            }

            throw new $error;
        }
    }
}