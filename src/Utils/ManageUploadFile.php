<?php

namespace GpiPoligran\Utils;
use \Upload\Storage\FileSystem;
use \Upload\File;
use GpiPoligran\Utils\ManageSlugify;

class ManageUploadFile{
    public static function getNewName($file){
        $name = $file->getName();
        $timestamp = time();

        return "$name-$timestamp";
    }

    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
    // public static function validateSize($file,$size){
    //     $validator = new \Upload\Validation\Size($size);
    //     return $validator->validate( $file );
    // }

    // public static function validateType($file,$type){
    //     $validator = new Mimetype($type);
    //     return $validator->validate( $file );
    // }

    // public static function validateDimensions($file,$validators = []){
    //     $dimensions = $file->getDimensions();
    //     $result = true;

    //     foreach($validators as $validator){
    //         if(!$validator($dimensions['width'],$dimensions['height'])){
    //             $result = false;
    //             break;
    //         }
    //     }

    //     return $result;
    // }

    public static function upload($fileName,$dir){
        $defDir = $_ENV['UPLOADS_DIR'].'/'.$dir;
    
        if(!is_dir($defDir)){
            mkdir($defDir,0777,true);
        }

        $storage = new FileSystem($defDir);
        $file = new File($fileName, $storage);

        // $oldName = $file->getName();
        $fileNewName = ManageUploadFile::getNewName($file);
        $fileNameSlugify = ManageSlugify::generateSlug($fileNewName);
        $file->setName($fileNameSlugify);   

        // $uploadedFileData = new UploadedFileData(
        //     $fileNameSlugify,
        //     $dir.'/'.$fileNameSlugify.'.'.$file->getExtension(),
        //     $file->getSize(),
        //     $fileDimensions
        // );
        
        $file->upload();

        return $fileNameSlugify;

        // return $uploadedFileData;
    }
}