<?php

namespace GpiPoligran\Services\Specialties;
use GpiPoligran\Models\Specialty;

final class GetSpecialty{
    private $id;

    public function __construct($id)
    {
       $this->id = $id; 
    }

    public function register(){
        $specialty = Specialty::where('id',$this->id);                    
        $specialty = $specialty
                        ->get()
                        ->toArray();        
        
        return count($specialty) ? $specialty[0] : null;
    }
}