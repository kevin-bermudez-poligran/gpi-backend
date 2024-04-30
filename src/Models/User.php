<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model {
        protected $table = 'users';
        protected $fillable = [
            'name',
            'email',
            'password',
            'profile',
            'identification_number'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;
    }