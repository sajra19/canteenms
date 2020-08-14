<?php

/**
* @OA\Get(
*     path="/admin",
*     tags={"admin"},
*     summary="Get list of all admins",
*     description="Get list of all admins",
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
Flight::route('GET /admin', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $admins = Flight::admin_service()->get_admins(Flight::request()->query['status']);
    Flight::json($admins);
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
 * @OA\Patch(
 *     path="/admin/{id}/status",
 *     tags={"admin"},
 *     summary="Update admin status",
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
Flight::route('PATCH /admin/@id/status', function ($id, $route) {

    $admin = Flight::admin_service()->update_status($id, Flight::request()->query['status']);
    Flight::json($admin);
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
