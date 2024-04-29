<?php
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/Config/EnvVariables.php';
    
    use GpiPoligran\Config\Database;

    Database::connect();

    