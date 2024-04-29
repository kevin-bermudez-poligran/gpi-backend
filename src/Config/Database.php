<?php
    namespace GpiPoligran\Config;
    use Illuminate\Database\Capsule\Manager as Capsule;
    // use CommunityFutbolInterfaces\Config\ConnectionDatabase;

    class Database {
        public static function connect(){
            $capsule = new Capsule;   
            $capsule->addConnection([
                'driver'   => 'mysql',
                'host'     => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
                'port' => $_ENV['DB_PORT'],
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'timezone'  => '+05:00',
                'options'   => [
                    \PDO::ATTR_EMULATE_PREPARES => true
                ]
            ]);
            
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        }
    }