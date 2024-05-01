<?php

namespace GpiPoligran\Services\System;
use GpiPoligran\Models\User;

final class InstallIsRequired{
    public function register(){
        $users = User::select('*')->get()->toArray();

        return !count($users);
    }
}