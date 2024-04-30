<?php
    namespace GpiPoligran\Api\Routes;
    use GpiPoligran\Utils\Validator;
    use GpiPoligran\Exceptions\Service as ServiceError;
    use GpiPoligran\Exceptions\InternalCodeError;

    class RouteBase {
        protected $request;
        protected $response;
        protected $validator;

        public function __construct($request,$response){
            $this->request  = $request;
            $this->response = $response;
            $this->validator = new Validator;
        }

        protected function sendResponse(int $code,string $message,array $data = [],array $errors = [],InternalCodeError $internalCodeError = null){
            $jsonResponse = array(
                'success' => $code < 300,
                'message' => $message
            );

            if(count($data)){
                $jsonResponse['data'] = $data;
            }

            if(count($errors)){
                $jsonResponse['errors'] = $errors;
            }

            if($internalCodeError){
                $jsonResponse['internal_code'] = $internalCodeError;
            }
     
            $this->response->status($code)->json($jsonResponse);
            exit();
        }

        protected function handlerException($error){
            $errorStatus  = 500;
            $messageError = 'Internal Server Error';
            $errors       = [];
            $internalCodeError = null;

            if($error instanceof ServiceError){
                $errorStatus  = $error->status ? $error->status : 400;
                $messageError = $error->publicMessage ? $error->publicMessage : 'The information provided has errors';
                $errors       = $error->getErrors();

                if(isset($error->internalCode)){
                    $internalCodeError = $error->internalCode;
                }
            }

            return self:: sendResponse($errorStatus,$messageError,[],$errors,$internalCodeError);
        }
    }