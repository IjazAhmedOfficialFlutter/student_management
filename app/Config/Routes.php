<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Auth::login');

$routes->get('test', 'Test::index');
$routes->get('test-users', 'Test::users');
$routes->get('test-students', 'Test::students');
$routes->get('test-subjects', 'Test::subjects');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login/authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');
$routes->get('test-classes', 'Test::classes');

$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('students', 'Students::index', ['filter' => 'auth']);
$routes->get('students/archive', 'Students::archive', ['filter' => 'auth']);
$routes->get('students/restore/(:num)', 'Students::restore/$1', ['filter' => 'auth']);
$routes->get(
    'students/archiveStudent/(:num)',
    'Students::archiveStudent/$1',
    ['filter' => 'auth']
);
$routes->get('students/create', 'Students::create', ['filter' => 'auth']);
$routes->post('students/store', 'Students::store', ['filter' => 'auth']);
$routes->get('students/edit/(:num)', 'Students::edit/$1', ['filter' => 'auth']);
$routes->post('students/update/(:num)', 'Students::update/$1', ['filter' => 'auth']);
$routes->get('students/delete/(:num)', 'Students::delete/$1', ['filter' => 'auth']);

$routes->get('classes', 'Classes::index', ['filter' => 'auth']);
$routes->get('classes/create', 'Classes::create', ['filter' => 'auth']);
$routes->post('classes/store', 'Classes::store', ['filter' => 'auth']);
$routes->get('classes/(:num)/students', 'Classes::students/$1', ['filter' => 'auth']);
$routes->get('classes/edit/(:num)', 'Classes::edit/$1', ['filter' => 'auth']);
$routes->post('classes/update/(:num)', 'Classes::update/$1', ['filter' => 'auth']);
$routes->get('classes/delete/(:num)', 'Classes::delete/$1', ['filter' => 'auth']);

$routes->get('subjects', 'Subjects::index', ['filter' => 'auth']);
$routes->get('subjects/create', 'Subjects::create', ['filter' => 'auth']);
$routes->post('subjects/store', 'Subjects::store', ['filter' => 'auth']);
$routes->get('subjects/edit/(:num)', 'Subjects::edit/$1', ['filter' => 'auth']);
$routes->post('subjects/update/(:num)', 'Subjects::update/$1', ['filter' => 'auth']);
$routes->get('subjects/delete/(:num)', 'Subjects::delete/$1', ['filter' => 'auth']);


// Attendance
$routes->get('attendance', 'Attendance::index', ['filter' => 'auth']);
$routes->get('attendance/mark', 'Attendance::mark', ['filter' => 'auth']);
$routes->post('attendance/store', 'Attendance::store', ['filter' => 'auth']);
$routes->get('attendance/history', 'Attendance::history', ['filter' => 'auth']);

// Reports
$routes->get('reports', 'Reports::index', ['filter' => 'auth']);
$routes->get('reports/class-wise', 'Reports::classWise', ['filter' => 'auth']);
$routes->get('reports/attendance-summary', 'Reports::attendanceSummary', ['filter' => 'auth']);


$routes->get('language/(:segment)', 'LanguageController::change/$1');