<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

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
    }