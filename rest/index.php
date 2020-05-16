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


Flight::route('GET /employee', function(){
  $employee = Flight::employee_dao()->get_all();
 Flight::json($employee);
});


Flight::route('GET /employee', function(){
  $id = Flight::request()->query['id'];
  $employee = Flight::employee_dao()->get_by_id($id);
   Flight::json($employee);
 });


 Flight::route('POST /employee', function(){
   $request = Flight::request()->data->getData();
   $request['fname'] = $request['fname'];
 $request['orderdate'] = $request['orderdate'];
 $request['ordertime'] = $request['ordertime'];
 $request['status'] = $request['status'];
  $request['amount'] = $request['amount'];
 unset($request['fname'], $request['orderdate'], $request['ordertime'], $request['status'], $request['amount']);
 Flight::employee_dao()->add($request);
 Flight::json('Order has been added');
});


Flight::start();
?>
