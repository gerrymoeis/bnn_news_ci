<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('post/(:segment)', 'PostController::show/$1');

// Password Reset Routes
    // Simplified Password Reset Flow
    $routes->get('password/forgot', 'PasswordController::forgot');
    $routes->post('password/process-email', 'PasswordController::processEmail');
    $routes->get('password/new', 'PasswordController::newPasswordForm');
    $routes->post('password/update', 'PasswordController::updatePassword');

// Dashboard & Profile Routes (Protected)
$routes->group('dashboard', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'DashboardController::index');
    // Add other dashboard routes here in the future
});

$routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);
$routes->post('profile/update-details', 'ProfileController::updateDetails', ['filter' => 'auth']);
$routes->post('profile/update-password', 'ProfileController::updatePassword', ['filter' => 'auth']);

// Logout Route
$routes->get('logout', 'AuthController::logout');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('category/(:segment)', 'Home::postsByCategory/$1');

// Authentication Routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('logout', 'AuthController::logout');

// Admin Routes
$routes->group('admin', ['filter' => ['auth', 'role:1']], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('users/pending', 'AdminController::pendingUsers');
    $routes->get('users/approve/(:num)', 'AdminController::approveUser/$1');

    // Category CRUD
    $routes->get('categories', 'AdminController::manageCategories');
    $routes->get('categories/new', 'AdminController::createCategory');
    $routes->post('categories/create', 'AdminController::storeCategory');
    $routes->get('categories/edit/(:num)', 'AdminController::editCategory/$1');
    $routes->post('categories/update/(:num)', 'AdminController::updateCategory/$1');
    $routes->get('categories/delete/(:num)', 'AdminController::deleteCategory/$1');
});

// Post Management Routes (Wartawan & Editor)
$routes->group('posts', ['filter' => ['auth', 'role:3']], function ($routes) { // Changed to role:3 only
    $routes->get('/', 'PostController::index');
    $routes->get('new', 'PostController::new');
    $routes->post('create', 'PostController::create');
    $routes->get('edit/(:num)', 'PostController::edit/$1');
    $routes->post('update/(:num)', 'PostController::update/$1');
    $routes->get('delete/(:num)', 'PostController::delete/$1');
});

// Editor Specific Routes
$routes->group('editor', ['filter' => ['auth', 'role:2']], function ($routes) {
    $routes->get('pending', 'PostController::pendingApproval');
    $routes->get('approve/(:num)', 'PostController::approve/$1');
    $routes->get('reject/(:num)', 'PostController::reject/$1');
});

