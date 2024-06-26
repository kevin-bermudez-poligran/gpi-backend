<?php
	namespace GpiPoligran\Utils;

	final class ManageGuid {
		public static function generate() : string{
            if (function_exists('com_create_guid')){
                return com_create_guid();
            }

            mt_srand((double)microtime()*10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid = trim(chr(123)
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125),'{}');
            return $uuid;
		}
	}