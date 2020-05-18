<?php

/**
* @OA\Get(
*     path="/employees",
*     tags={"employees"},
*     summary="Get list of all employees",
*     description="Get list of all employees",
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /employees', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $employees = Flight::employee_service()->get_employees();
    Flight::json($employees);
}, true);

/**
 *
 * @OA\Post(
 *     path="/employee",
 *     tags={"employee"},
 *     summary="Add new employee",
 * )
 */
Flight::route('POST /employee', function ($route) {  
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::employee_service()->add_employee(Flight::request()->data->getData());
    Flight::json('Employee has been added');
}, true);

/**
 *
 * @OA\Delete(
 *     path="/employee/{id}",
 *     tags={"employees"},
 *     summary="Delete employee",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 * )
 */
Flight::route("DELETE /employee/@id", function ($id, $route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    Flight::employee_service()->delete_employee($id);
    Flight::json('Employee has been deleted');
}, true);
