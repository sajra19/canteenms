<?php
/**
 * Entry point for the FlightPHP project, bundled with Swagger OpenAPI documentation generator.
 */

require_once 'autoload.php';

<<<<<<< HEAD
/**
 * Start the Flight framework.
 */
Flight::start();
=======
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
>>>>>>> 010f444f7d29e5caf4fde5ae8b8f27ee7d7cf890
