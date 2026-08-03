<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ============================================================================
// Default Routes
// ============================================================================

$routes->get('/', 'Auth::login');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login/authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');

// Language
$routes->get('language/(:segment)', 'LanguageController::change/$1');

// ============================================================================
// Development / Testing
// ============================================================================

$routes->get('test', 'Test::index');
$routes->get('test-users', 'Test::users');
$routes->get('test-students', 'Test::students');
$routes->get('test-subjects', 'Test::subjects');
$routes->get('test-classes', 'Test::classes');

$routes->get('verify-hash', 'Test::verifyHash');
$routes->get('test-hash', 'Test::hash');

// ============================================================================
// Protected Routes
// ============================================================================

$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ------------------------------------------------------------------------
    // Dashboard
    // ------------------------------------------------------------------------

    $routes->get('dashboard', 'Dashboard::index');

    // ------------------------------------------------------------------------
    // Students
    // ------------------------------------------------------------------------

    $routes->group('students', function ($routes) {

        $routes->get('/', 'Students::index');

        $routes->get('create', 'Students::create');
        $routes->post('store', 'Students::store');

        $routes->get('edit/(:num)', 'Students::edit/$1');
        $routes->post('update/(:num)', 'Students::update/$1');

        $routes->get('archive', 'Students::archive');
        $routes->get('archiveStudent/(:num)', 'Students::archiveStudent/$1');
        $routes->get('restore/(:num)', 'Students::restore/$1');

        $routes->get('delete/(:num)', 'Students::delete/$1');

        $routes->get(
            'changeStatus/(:num)/(:segment)',
            'Students::changeStatus/$1/$2'
        );
    });

    // ------------------------------------------------------------------------
    // Teachers
    // ------------------------------------------------------------------------

    $routes->group('teachers', function ($routes) {

        $routes->get('/', 'Teachers::index');

        $routes->get('create', 'Teachers::create');
        $routes->post('store', 'Teachers::store');

        $routes->get('view/(:num)', 'Teachers::view/$1');

        $routes->get('edit/(:num)', 'Teachers::edit/$1');
        $routes->post('update/(:num)', 'Teachers::update/$1');

        $routes->get('archive/(:num)', 'Teachers::archiveTeacher/$1');
        $routes->get('archived', 'Teachers::archived');
        $routes->get('restore/(:num)', 'Teachers::restore/$1');
    });

    // ------------------------------------------------------------------------
    // Teacher Assignments
    // ------------------------------------------------------------------------

    $routes->group('teacher-assignments', function ($routes) {

        $routes->get('/', 'TeacherAssignments::index');

        $routes->get('create', 'TeacherAssignments::create');
        $routes->post('store', 'TeacherAssignments::store');

        $routes->get('edit/(:num)', 'TeacherAssignments::edit/$1');
        $routes->post('update/(:num)', 'TeacherAssignments::update/$1');

        $routes->get('archive/(:num)', 'TeacherAssignments::archive/$1');
        $routes->get('archived', 'TeacherAssignments::archived');
        $routes->get('restore/(:num)', 'TeacherAssignments::restore/$1');
    });

    // ------------------------------------------------------------------------
    // Classes
    // ------------------------------------------------------------------------

    $routes->group('classes', function ($routes) {

        $routes->get('/', 'Classes::index');

        $routes->get('create', 'Classes::create');
        $routes->post('store', 'Classes::store');

        $routes->get('(:num)/students', 'Classes::students/$1');

        $routes->get('edit/(:num)', 'Classes::edit/$1');
        $routes->post('update/(:num)', 'Classes::update/$1');

        $routes->get('delete/(:num)', 'Classes::delete/$1');
    });

    // ------------------------------------------------------------------------
    // Subjects
    // ------------------------------------------------------------------------

    $routes->group('subjects', function ($routes) {

        $routes->get('/', 'Subjects::index');

        $routes->get('create', 'Subjects::create');
        $routes->post('store', 'Subjects::store');

$routes->get('show/(:num)', 'Subjects::show/$1');
        $routes->get('edit/(:num)', 'Subjects::edit/$1');
        $routes->post('update/(:num)', 'Subjects::update/$1');

        $routes->get('delete/(:num)', 'Subjects::delete/$1');
    });

    // ------------------------------------------------------------------------
    // Attendance
    // ------------------------------------------------------------------------

    $routes->group('attendance', function ($routes) {

        $routes->get('/', 'Attendance::index');

        $routes->get('mark', 'Attendance::mark');
        $routes->post('store', 'Attendance::store');

        $routes->get('history', 'Attendance::history');
    });

    // ------------------------------------------------------------------------
    // Reports (Admin Only)
    // ------------------------------------------------------------------------

    $routes->group('reports', ['filter' => 'role:Admin'], function ($routes) {

        $routes->get('/', 'Reports::index');

        $routes->get('class-wise', 'Reports::classWise');
        $routes->get('classes/detail/(:num)', 'Reports::classDetail/$1');
        $routes->get('attendance-summary', 'Reports::attendanceSummary');

        $routes->get('students', 'Reports::students');
        $routes->get('students/all', 'Reports::allStudents');
        $routes->get('students/active', 'Reports::activeStudents');
        $routes->get('students/archive', 'Reports::archivedStudents');
        $routes->get('students/detail/(:num)', 'Reports::student/$1');
    });

    // ------------------------------------------------------------------------
    // Reset Password
    // ------------------------------------------------------------------------

    $routes->get('reset-password/(:num)', 'Auth::resetPassword/$1');
    $routes->post('auth/update-password/(:num)', 'Auth::updatePassword/$1');

});