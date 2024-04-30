<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;
    use GpiPoligran\Models\{
        Specialty,
        User
    };

    class Specialist extends Model {
        protected $table = 'specialists';
        protected $fillable = [
            'specialist',
            'specialty',
            'status'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;

        public function specialistData()
        {
            return $this->hasOne(User::class,'id','specialist');
        }

        public function specialtyData()
        {
            return $this->hasOne(Specialty::class,'id','specialty');
        }
    }