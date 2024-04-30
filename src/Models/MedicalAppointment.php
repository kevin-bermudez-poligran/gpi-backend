<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;
    use GpiPoligran\Models\SpecialistSchedule;

    class MedicalAppointment extends Model {
        protected $table = 'medical_appointments';
        protected $fillable = [
            'order',
            'schedule',
            'status'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;

        public function scheduleData()
        {
            return $this->hasOne(SpecialistSchedule::class,'id','schedule');
        }

    }