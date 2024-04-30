<?php

namespace GpiPoligran\Services\DatabaseAdmin;

use GpiPoligran\Config\MedicalAppointmentStatusEnum;
use GpiPoligran\Config\MedicalOrderStatusEnum;
use GpiPoligran\Config\ProfilesEnum;
use GpiPoligran\Config\SpecialistScheduleStatusEnum;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Capsule\Manager as DB;
use GpiPoligran\Exceptions\{
    Service as ServiceError
};

final class Migrate{

    public function register(){
        try{
            $this->createUsersTable();
            $this->createSpecialistsTable();
            $this->createSpecialtiesTable();
            $this->createSpecialistSchedulesTable();
            $this->createMedicalOrderTable();
            $this->createMedicalAppointmentTable();
        }
        catch(\Exception $error){
            throw new ServiceError([],'Can`t migrate database',500);
        }
    }

    private function createSpecialistSchedulesTable(){
        if (!Capsule::schema()->hasTable('specialist_schedules')) {
            Capsule::schema()->create('specialist_schedules',function($table){
                $table->increments('id');
                $table->dateTime('start_date');
                $table->dateTime('end_date');
                $table->integer('specialist');
                $table->integer('status')->default( SpecialistScheduleStatusEnum::AVAILABLE );
               
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }
    }
    
    private function createSpecialistsTable(){
        if (!Capsule::schema()->hasTable('specialists')) {
            Capsule::schema()->create('specialists',function($table){
                $table->increments('id');
                $table->integer('specialist');
                $table->integer('specialty');
               
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }
    }

    private function createSpecialtiesTable(){
        if (!Capsule::schema()->hasTable('specialties')) {
            Capsule::schema()->create('specialties',function($table){
                $table->increments('id');
                $table->string('name',255);
               
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
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

    private function createMedicalOrderTable(){
        if (!Capsule::schema()->hasTable('medical_orders')) {
            Capsule::schema()->create('medical_orders',function($table){
                $table->increments('id');
                $table->integer('specialist');
                $table->integer('user');
                $table->text('description')->nullable();
                $table->integer('status')->default( MedicalOrderStatusEnum::PENDING );
               
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }
    }

    private function createMedicalAppointmentTable(){
        if (!Capsule::schema()->hasTable('medical_appointments')) {
            Capsule::schema()->create('medical_appointments',function($table){
                $table->increments('id');
                $table->integer('order');
                $table->integer('schedule');
                $table->integer('status')->default( MedicalAppointmentStatusEnum::SCHEDULED );
               
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            });
        }
    }
}