<?php

/**
* @OA\Get(
*     path="/employees",
*     tags={"employee"},
*     summary="Get list of all employees",
*     description="Get list of all employees",
*     @OA\Parameter(
*         name="id",
*         in="query",
*         required=false,
*         @OA\Schema(
*             type="string"
*         )
*     )
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /employees', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $employee = Flight::employee_service()->get_employees(Flight::request()->query['status']);
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
   $employee = Flight::employee_service()->get_by_user_id(Flight::request()->query['id']);
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
    $message = Flight::employee_service()->add_employee(Flight::request()->data->getData());
    Flight::json($message);
}, true);



/**
 *
 * @OA\Post(
 *     path="/employees/edit",
 *     tags={"employee"},
 *     summary="Edit employee",
 * )
 */
Flight::route('POST /employee/edit', function ($route) {
    Flight::employee_service()->update_employee(Flight::request()->data->getData());
    Flight::json('Employee has been updated');
}, true);

/**
 *
 * @OA\Patch(
 *     path="/employee/{id}/status",
 *     tags={"employee"},
 *     summary="Update employee status",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     )
 * )
 */
Flight::route('PATCH /employee/@id/status', function ($id, $route) {

    $employee = Flight::employee_service()->update_status($id, Flight::request()->query['status']);
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




/**
 *
 * @OA\Patch(
 *     path="/employee/{id}/reset_password",
 *     tags={"employees"},
 *     summary="Update employee status",
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
Flight::route('PATCH /employee/@id/reset_password', function ($id, $route) {

    $password = Flight::employee_service()->reset_password($id);
    Flight::json($password);
}, true);
