<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;
    use GpiPoligran\Models\{
        Specialist,
        User
    };

    class MedicalOrder extends Model {
        protected $table = 'medical_orders';
        protected $fillable = [
            'specialist',
            'user',
            'description',
            'status'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;

        public function specialistData()
        {
            return $this->hasOne(Specialist::class,'id','specialist');
        }

        public function userData()
        {
            return $this->hasOne(User::class,'id','user');
        }
    }