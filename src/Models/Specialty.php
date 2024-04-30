<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

    class Specialty extends Model {
        protected $table = 'specialties';
        protected $fillable = [
            'name'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;
    }