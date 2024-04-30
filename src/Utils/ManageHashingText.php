<?php
    namespace GpiPoligran\Utils;

    final class ManageHashingText {
        public static function generateHash($text) : string {
            return password_hash(strval($text),PASSWORD_DEFAULT);
        }
        
        public static function verifyHash(string $text,string $hash) : bool {
            return password_verify($text,$hash);
        }
    }