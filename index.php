<?php

session_start();

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//include all your model files here
require 'Model/User.php';
//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/InfoController.php';
require 'Controller/DashboardController.php';
require 'Controller/LoginController.php';
require 'Controller/RegisterController.php';
require 'Controller/BecodersController.php';
require 'Controller/SuccesController.php';
require 'Controller/BlogController.php';
require 'Controller/AddexperienceController.php';
require 'Controller/AddeducationController.php';
require 'Controller/MyProfileController.php';

// Database connections
require_once 'Controller/DatabaseManager.php';
require_once 'config.php';
$databaseManager = new DatabaseManager($config['host'], $config['name'], $config['password'], $config['dbname'], $config['port']);
$databaseManager->connect();

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller

$controller = new HomepageController();
if (isset($_GET['page']) && $_GET['page'] === 'info') {
    $controller = new InfoController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'dashboard') {
    $controller = new DashboardController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'login') {
    $controller = new LoginController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'register') {
    $controller = new RegisterController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'becoders') {
    $controller = new BecodersController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'succes') {
    $controller = new SuccesController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'addexperience') {
    $controller = new AddexperienceController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'addeducation') {
    $controller = new AddeducationController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'blog') {
    $controller = new BlogController($databaseManager);
} else if (isset($_GET['page']) && $_GET['page'] === 'myprofile') {
    $controller = new MyProfileController($databaseManager);
}

$controller->render($_GET, $_POST);
