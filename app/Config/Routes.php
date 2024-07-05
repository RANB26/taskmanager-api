<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', function($routes){
    $routes->resource('tareas');    //api/tareas
    $routes->resource('usuarios');    //api/usuarios
});
