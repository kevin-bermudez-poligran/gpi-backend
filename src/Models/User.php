<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;
    use GpiPoligran\Models\Specialist;

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

        public function specialist(){
            return $this->hasOne(Specialist::class,'specialist','id');
        }
    }