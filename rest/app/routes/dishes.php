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
Flight::route('GET /dishes', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $dishes = Flight::dishes_service()->get_dishes();
    Flight::json($dishes);
}, true);

/**
 *
 * @OA\Post(
 *     path="/dishes",
 *     tags={"dish"},
 *     summary="Add new dish",
 * )
 */
Flight::route('POST /dishes', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::dishes_service()->add_dishes(Flight::request()->data->getData());
    Flight::json('Dish has been added');
}, true);

/**
 *
 * @OA\Post(
 *     path="/dish_to_cart",
 *     tags={"dish"},
 *     summary="Add dish to cart",
 * )
 */
Flight::route('POST /dish_to_cart', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::dishes_service()->add_to_cart(Flight::request()->data->getData());
    Flight::json('Dish has been added');
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
Flight::route("DELETE /dish/@id", function ($id, $route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    Flight::dishes_service()->delete_dish($id);
    Flight::json('Dish has been deleted');
}, true);
