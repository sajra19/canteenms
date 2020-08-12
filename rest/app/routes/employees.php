<?php

/**
* @OA\Get(
*     path="/employees",
*     tags={"employee"},
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
    $employee = Flight::employee_service()->get_employees();
    Flight::json($employee);
}, true);



/**
* @OA\Get(
*     path="/employees/id",
*     tags={"employee"},
*     summary="Get employee by its id",
*     description="Get employee by its id",
*     @OA\Parameter(
*         name="id",
*         in="query",
*         required=false,
*         @OA\Schema(
*             type="string"
*         )
*     )
* )
*/
Flight::route('GET /employees/id', function () {
   $employee = Flight::employee_service()->get_employee_by_id(Flight::request()->query['id']);
   Flight::json($employee);
}, true);



/**
 *
 * @OA\Post(
 *     path="/employee",
 *     tags={"employee"},
 *     summary="Add new employee",
 * )
 */
Flight::route('POST /employees', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::employee_service()->add_employee(Flight::request()->data->getData());
    Flight::json('Employee has been added');
}, true);



/**
 *
 * @OA\Post(
 *     path="/employees/edit",
 *     tags={"employee"},
 *     summary="Edit employee",
 * )
 */
Flight::route('POST /employees/edit', function ($route) {
    Flight::employee_service()->update_employee(Flight::request()->data->getData());
    Flight::json('Employee has been updated');
}, true);




/**
 *
 * @OA\Patch(
 *     path="/employees/{id}/status",
 *     tags={"employee"},
 *     summary="Delete employee",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     )
 * )
 */
Flight::route('PATCH /employees/@id/status', function ($id, $route) {

    $employee = Flight::employee_service()->update_employee_status($id);
    Flight::json($employee);
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
Flight::route("DELETE /employees/@id", function ($id, $route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    Flight::employee_service()->delete_employee($id);
    Flight::json('Employee has been deleted');
}, true);
