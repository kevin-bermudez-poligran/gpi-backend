<?php
    namespace GpiPoligran\Exceptions;

    class InternalCodeError{
        public string $module;
        public string $id;
        public array $data;

        const CODES = [
            'GENERAL' => [
                'name' => 'GENERAL',
                'codes' => [
                    'PAYLOAD_VALIDATION' => 'PVG'
                ]
            ],
            'USER' => [
                'name' => 'user',
                'codes' => [
                    'FAIL_CREATE_USER' => 'UFCU'
                ]
            ]
        ];

        public function __construct(string $module,string $id,array $data = []) {
            $this->module = $module;
            $this->id = $id;
            
            if(count($data)){
                $this->data = $data;
            }
        }
    }