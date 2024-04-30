<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

    class Specialist extends Model {
        protected $table = 'specialists';
        protected $fillable = [
            'specialist',
            'specialty'
        ];
        public $incrementing = true;
        protected $primaryKey = 'id';
        public $timestamps = true;
    }