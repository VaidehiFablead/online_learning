<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', [AuthController::class,'index']);
$routes->get('register', [AuthController::class,'registerPage']);

$routes->post('/', [AuthController::class,'login']);
$routes->post('register', [AuthController::class,'register']);

$routes->get('logout', [AuthController::class,'logout']);

$routes->get('dashboard', [DashboardController::class,'index']);

