<?php

namespace GpiPoligran\Services\DatabaseAdmin;
use GpiPoligran\Config\ProfilesEnum;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Capsule\Manager as DB;
use GpiPoligran\Exceptions\{
    Service as ServiceError
};

final class Migrate{

    public function register(){
        try{
            $this->createUsersTable();
        }
        catch(\Exception $error){
            throw new ServiceError([],'Can`t migrate database',500);
        }
    }

    private function createUsersTable(){
        if (!Capsule::schema()->hasTable('users')) {
            Capsule::schema()->create('users',function($table){
                $table->increments('id');
                $table->string('name',255);
                $table->string('email',255)->unique();
                $table->string('password',255);
                $table->integer('profile')->default( ProfilesEnum::PATIENT );
                $table->integer('identification_number')->nullable();
               
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }
    }
}