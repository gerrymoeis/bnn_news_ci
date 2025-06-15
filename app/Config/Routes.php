<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// == PUBLIC ROUTES ==
$routes->get('/', 'HomeController::index');
$routes->get('/about', 'PageController::about');
$routes->get('/contact', 'PageController::contact');
$routes->get('post/(:segment)', 'PostController::show/$1');
$routes->get('category/(:segment)', 'HomeController::postsByCategory/$1');

// --- Authentication ---
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::processRegister');
$routes->get('logout', 'AuthController::logout');

// --- Password Reset ---
$routes->get('password/forgot', 'PasswordController::forgot');
$routes->post('password/forgot', 'PasswordController::processForgot');
$routes->get('password/reset/(:any)', 'PasswordController::reset/$1');
$routes->post('password/reset', 'PasswordController::processReset');


// == PROTECTED ROUTES ==

// --- Dashboard ---
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// --- Profile (All Logged-in Users) ---
$routes->group('profile', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->post('update-details', 'ProfileController::updateDetails');
    $routes->post('update-password', 'ProfileController::updatePassword');
});

// --- Admin (Role: 1) ---
$routes->group('admin', ['filter' => ['auth', 'role:1']], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    
    // User Management
    $routes->get('users', 'AdminController::manageUsers');
    $routes->get('users/pending', 'AdminController::pendingUsers');
    $routes->get('users/approve/(:num)', 'AdminController::approveUser/$1');
    $routes->get('users/edit/(:num)', 'AdminController::editUser/$1');
    $routes->post('users/update/(:num)', 'AdminController::updateUser/$1');
    $routes->get('users/delete/(:num)', 'AdminController::deleteUser/$1');

    // Category Management
    $routes->get('categories', 'AdminController::manageCategories');
    $routes->get('categories/new', 'AdminController::createCategory');
    $routes->post('categories/create', 'AdminController::storeCategory');
    $routes->get('categories/edit/(:num)', 'AdminController::editCategory/$1');
    $routes->post('categories/update/(:num)', 'AdminController::updateCategory/$1');
    $routes->get('categories/delete/(:num)', 'AdminController::deleteCategory/$1');
});

// --- Editor (Role: 2) ---
$routes->group('editor', ['filter' => ['auth', 'role:2']], function ($routes) {
    $routes->get('pending', 'PostController::pendingApproval');
    $routes->get('approve/(:num)', 'PostController::approve/$1');
    $routes->get('reject/(:num)', 'PostController::reject/$1');
});

// --- Wartawan (Role: 3) ---
$routes->group('posts', ['filter' => ['auth', 'role:3']], function ($routes) {
    $routes->get('/', 'PostController::index');
    $routes->get('new', 'PostController::new');
    $routes->post('create', 'PostController::create');
    $routes->get('edit/(:num)', 'PostController::edit/$1');
    $routes->post('update/(:num)', 'PostController::update/$1');
    $routes->get('delete/(:num)', 'PostController::delete/$1');
});
