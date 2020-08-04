<?php

/**
* @OA\Get(
*     path="/orders",
*     tags={"orders"},
*     summary="Get list of all orders",
*     description="Get list of all orders",
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /orders', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $orders = Flight::orders_service()->get_orders();
    Flight::json($orders);
}, true);

/**
 *
 * @OA\Post(
 *     path="/orders",
 *     tags={"orders"},
 *     summary="Add new orders",
 * )
 */
Flight::route('POST /orders', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::orders_service()->add_orders(Flight::request()->data->getData());
    Flight::json('orders has been added');
}, true);

/**
 *
 * @OA\Delete(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Delete orders",
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
Flight::route("DELETE /orders/@id", function ($id, $route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    Flight::orders_service()->delete_orders($id);
    Flight::json('orders has been deleted');
}, true);
