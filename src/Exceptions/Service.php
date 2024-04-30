<?php
    namespace GpiPoligran\Exceptions;
    use Exception;
    use GpiPoligran\Exceptions\InternalCodeError;

    final class Service extends Exception {
        private $errors;
        public int $status;
        public string $publicMessage;
        public InternalCodeError $internalCode;

        public function __construct(array $errors,string $messageForUser = '',int $code = 0,InternalCodeError $internalCode = null,Exception $previous = null){
            $this->status = $code;
            parent:: __construct($messageForUser ? $messageForUser : 'Service error', $code, $previous);
            $this->errors        = $errors;
            $this->publicMessage = $messageForUser;
            
            if($internalCode){
                $this->internalCode = $internalCode;
            }
        }

        public function getErrors(){
            return $this->errors;
        }
    }