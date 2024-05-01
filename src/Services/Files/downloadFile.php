<?php
    require '../../../vendor/autoload.php';
    require '../../Config/EnvVariables.php';

    try{
        $fileName = $_ENV['UPLOADS_DIR'] . '/' . $_GET['path'];
        header("Content-Transfer-Encoding: binary");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename( $_GET['path']) );
        readfile($fileName);
    }
    catch(\Exception $error){
        echo "Can`t download this file";
    }
    
?> git@poligran-github:kevin-bermudez-poligran/gpi-frontend.git

git remote add origin git@poligran-github:kevin-bermudez-poligran/gpi-backend.git