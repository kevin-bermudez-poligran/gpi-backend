<?php
    use GpiPoligran\Api\Routes\System\{
        Healtcheck,
        Install,
        Migrate,
        InstallIsRequired
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/system";
    
    $router->get("$prefix/healtcheck", function($req,$res){
        $routeHandler = new Healtcheck( $req,$res );
        return $routeHandler->run();
    });

    $router->post("$prefix/install", function($req,$res){
        $routeHandler = new Install( $req,$res );
        return $routeHandler->run();
    });

    $router->get("$prefix/migrate-db", function($req,$res){
        $routeHandler = new Migrate( $req,$res );
        return $routeHandler->run();
    });

    $router->get("$prefix/install-is-required", function($req,$res){
        $routeHandler = new InstallIsRequired( $req,$res );
        return $routeHandler->run();
    });