<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Models\User;

final class GetUsersByProfile{
    public function register($profile){
        return User::where('profile',$profile)
                    ->get()
                    ->toArray();
    }
}