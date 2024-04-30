<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

    class MedicalExamination extends Model {
        protected $table = 'medical_examination_results';
        protected $fillable = [
            'url',
            'user'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;
    }