<?php

/**
* @OA\Get(
*     path="/admin",
*     tags={"admin"},
*     summary="Get list of all admin",
*     description="Get list of all admin",
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /admin', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $admin = Flight::admin_service()->get_admin();
    Flight::json($admin);
}, true);

/**
 *
 * @OA\Post(
 *     path="/admin",
 *     tags={"admin"},
 *     summary="Add new admin",
 * )
 */
Flight::route('POST /admin', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::admin_service()->add_admin(Flight::request()->data->getData());
    Flight::json('Admin has been added');
}, true);

/**
 *
 * @OA\Delete(
 *     path="/admin/{id}",
 *     tags={"admin"},
 *     summary="Delete admin",
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
Flight::route("DELETE /admin/@id", function ($id, $route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    Flight::admin_service()->delete_admin($id);
    Flight::json('Admin has been deleted');
}, true);
