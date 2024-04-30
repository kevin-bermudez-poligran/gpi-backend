<?php
    namespace GpiPoligran\Utils;
    
    final class ManageCrypt {
        public static function encrypt($text) : string {
            if(is_array($text)){
                $text = json_encode($text);
            }

            $iv        = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($text, "aes-256-cbc", $_ENV['CRYPT_TEXT'], 0, $iv);

            return base64_encode($encrypted."::".$iv);
        }
        
        public static function decrypt(string $cryptText) {
            list($encryptedData, $iv) = explode('::', base64_decode($cryptText), 2);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $_ENV['CRYPT_TEXT'], 0, $iv);

            $resultJson = json_decode($decryptedData,true);
    
            if(json_last_error() === JSON_ERROR_NONE){
                $decryptedData = $resultJson;
            }

            return $decryptedData;
        }
    }