<?php

namespace GpiPoligran\Services\Users;

use GpiPoligran\Config\UserStatusEnum;
use GpiPoligran\Models\User;

final class GetUsersByProfile{
    public function register($profile){
        return User::where('profile',$profile)
                    ->where('status',UserStatusEnum::ACTIVE)
                    ->with('specialist',function($q){
                        $q->with('specialtyData');
                    })
                    ->get()
                    ->toArray();
    }
}