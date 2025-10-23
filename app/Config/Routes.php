<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route - redirects to homepage
$routes->get('/', 'Home::index');

// Main application routes
$routes->get('/home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// Authentication Routes
$routes->get('/register', 'Auth::register');     // Show registration form
$routes->post('/register', 'Auth::register');    // Process registration
$routes->get('/login', 'Auth::login');           // Show login form
$routes->post('/login', 'Auth::login');          // Process login
$routes->get('/logout', 'Auth::logout');         // Logout user
$routes->get('/dashboard', 'Auth::dashboard');   // User dashboard (fallback)

// Role-based Dashboard Routes
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::manageUsers');
    $routes->post('users/create', 'AdminController::createUser');
    $routes->post('users/update', 'AdminController::updateUser');
    $routes->post('users/delete', 'AdminController::deleteUser');
    $routes->get('courses', 'AdminController::manageCourses');
    $routes->post('courses/create', 'AdminController::createCourse');
    $routes->post('courses/update', 'AdminController::updateCourse');
    $routes->post('courses/delete', 'AdminController::deleteCourse');
    $routes->get('reports', 'AdminController::viewReports');
});

$routes->group('teacher', function($routes) {
    $routes->get('dashboard', 'TeacherController::dashboard');
    $routes->get('courses', 'TeacherController::manageCourses');
    $routes->get('course/(:num)/students', 'TeacherController::viewCourseStudents/$1');
    $routes->post('course/student/add', 'TeacherController::addStudentToCourse');
    $routes->post('course/student/remove', 'TeacherController::removeStudentFromCourse');
    $routes->get('assignments', 'TeacherController::manageAssignments');
    $routes->get('assignments/create', 'TeacherController::createAssignment');
    $routes->get('students', 'TeacherController::viewStudents');
    $routes->get('reviews', 'TeacherController::pendingReviews');
    $routes->get('gradebook', 'TeacherController::gradebook');
    $routes->get('announcements', 'TeacherController::announcements');
});

$routes->group('student', function($routes) {
    $routes->get('dashboard', 'StudentController::dashboard');
    $routes->get('courses', 'StudentController::viewCourses');
    $routes->get('course/(:num)', 'StudentController::viewCourse/$1');
    $routes->get('assignments', 'StudentController::viewAssignments');
    $routes->get('grades', 'StudentController::viewGrades');
    $routes->get('profile', 'StudentController::profile');
});

// Course Enrollment Routes 
$routes->post('/course/enroll', 'Course::enroll');
$routes->get('/course/available', 'Course::getAvailableCourses');