<?php
    namespace GpiPoligran\Models;
    use Illuminate\Database\Eloquent\Model;

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
    }