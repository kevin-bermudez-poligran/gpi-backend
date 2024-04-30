<?php

namespace GpiPoligran\Services\Users;
use GpiPoligran\Models\User;

final class GetUsers{
    public function register(){
        return User::select('*')
                    ->get()
                    ->toArray();
    }
}