<?php
    namespace GpiPoligran\Api\Routes;
    // use CommunityFutbolExceptions\Service as ServiceError;
    // use CommunityFutbolExceptions\InternalCodeError;

    class RouteBase {
        protected $request;
        protected $response;

        public function __construct($request,$response){
            $this->request  = $request;
            $this->response = $response;
        }
        protected static function sendResponse($response,int $code,string $message,array $data = [],array $errors = []){
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

            // if($internalCodeError){
            //     $jsonResponse['internal_code'] = $internalCodeError;
            // }
     
            $response->status($code)->json($jsonResponse);
            exit();
        }

        protected static function handlerException($response,$error){
            $errorStatus  = 500;
            $messageError = 'Internal Server Error';
            $errors       = [];
            $internalCodeError = null;

            // if($error instanceof ServiceError){
            //     $errorStatus  = $error->status ? $error->status : 400;
            //     $messageError = $error->publicMessage ? $error->publicMessage : 'The information provided has errors';
            //     $errors       = $error->getErrors();

            //     if(isset($error->internalCode)){
            //         $internalCodeError = $error->internalCode;
            //     }
            // }

            return self:: sendResponse($response,$errorStatus,$messageError,[],$errors,$internalCodeError);
        }
    }