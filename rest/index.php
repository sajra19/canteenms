<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

require '../vendor/autoload.php';
require 'config.php';
require 'dao/ProductDao.php';
require 'dao/EmployeeDao.php';

Flight::register('employee_dao', 'EmployeeDao');
Flight::register('product_dao', 'ProductDao');
Flight::register('admin_dao', 'AdminDao');


Flight::start();
?>
