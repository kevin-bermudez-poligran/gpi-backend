<?php

namespace GpiPoligran\Utils;
use GpiPoligran\Exceptions\Service as ServiceError;

final class HandleFiles{
    public static function createFile( $dirs,$fileName,$content ){
        try{
            if(!is_dir($_ENV['UPLOADS_DIR'] . '/' . $dirs)){
                mkdir($_ENV['UPLOADS_DIR'] . '/' . $dirs,0777,true);
            }
    
            $fullPath = $_ENV['UPLOADS_DIR'] . '/' . $dirs . '/' . $fileName;
            $fh = fopen($fullPath, 'w');
      
            $defContent = gettype($content) === 'string' ? [$content] : $content;
            
            foreach($defContent as $line){
                fwrite($fh, $line . "\r\n");
            }
            
            fclose($fh);
    
            return $fullPath;
        }
        catch(\Exception $error){
            print_r($error);
            throw new ServiceError( [],'Can`t create file',500 );
        }
    }
}