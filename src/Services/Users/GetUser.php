<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Models\User;

final class GetUser{
    private $email;

    public function __construct($email)
    {
       $this->email = $email; 
    }

    public function register(){
        $user = User::where('email',strval($this->email));
        
        if(gettype($this->email) === 'integer'){
            $user = $user->orWhere('identification_number',$this->email);
        }
                    
        $user = $user->get()
                    ->toArray();        
        
        return count($user) ? $user[0] : null;
    }
}