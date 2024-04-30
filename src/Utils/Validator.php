<?php

namespace GpiPoligran\Utils;
use Particle\Validator\Validator as ValidatorLib;

final class Validator extends ValidatorLib{
    public function __construct()
    {
        parent::__construct();
    }

    private function formattedErrors( $rawErrors ){
        $errors = [];
        if(!count($rawErrors)){
            return $errors;
        }
        
        foreach($rawErrors as $key => $error){
            foreach($error as $errorCode => $errorMessage){
                $errors[$key] = $errorMessage;
            }
        }
        return $errors;
    }

    public function validateSchema( array $data ) : array{
        $result = $this->validate( $data );
        return array(
            'isValid' => $result->isValid(),
            'errors'  => $this->formattedErrors( $result->getMessages() )
        );
    }
}