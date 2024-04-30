<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

    class SpecialistSchedule extends Model {
        protected $table = 'specialist_schedules';
        protected $fillable = [
            'start_date',
            'end_date',
            'specialist'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;
    }