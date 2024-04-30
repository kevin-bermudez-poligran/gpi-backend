<?php
    use GpiPoligran\Api\Routes\User\{
        CreateToken,
        CreateSuperAdmin,
        CreateManager,
        CreatePatient
    };
    use GpiPoligran\Config\Constants;

    $prefix = Constants::API_V1_PREFIX . "/users";

    $router->post("$prefix/login", function($req,$res){
        $routeHandler = new CreateToken( $req,$res );
        return $routeHandler->run();
    });

    $router->post("$prefix/superadmin", function($req,$res){
        $routeHandler = new CreateSuperAdmin( $req,$res );
        return $routeHandler->run();
    });

    $router->post("$prefix/manager", function($req,$res){
        $routeHandler = new CreateManager( $req,$res );
        return $routeHandler->run();
    });

    $router->post("$prefix/patient", function($req,$res){
        $routeHandler = new CreatePatient( $req,$res );
        return $routeHandler->run();
    });