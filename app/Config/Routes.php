<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\InstructorController;
use App\Controllers\ProfileController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// $routes->get('/unauthorized', 'Home::unauthorized');



$routes->get('/', [AuthController::class, 'index']);
$routes->get('register', [AuthController::class, 'registerPage']);

$routes->post('/', [AuthController::class, 'login']);
$routes->post('register', [AuthController::class, 'register']);

// Admin routes




$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('profile', [ProfileController::class, 'index']);
    $routes->post('update-profile', [ProfileController::class, 'updateProfile']);
    $routes->get('logout', [AuthController::class, 'logout']);

    // $routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    //     $routes->get('dashboard', 'AdminController::index');
    // });

    // Instructor routes
    $routes->group('instructor', ['filter' => 'role:instructor'], function ($routes) {
        $routes->get('dashboard', [InstructorController::class, 'index']);
    });

    // Student routes
    $routes->group('student', ['filter' => 'role:student'], function ($routes) {
        $routes->get('dashboard', [DashboardController::class, 'index']);
    });
});
