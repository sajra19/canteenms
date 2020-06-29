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
    $dishes = Flight::dish_service()->get_dish();
    Flight::json($dishes);
}, true);

/**
 *
 * @OA\Post(
 *     path="/employee",
 *     tags={"employee"},
 *     summary="Add new employee",
 * )
 */
Flight::route('POST /dish', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::dish_service()->add_dish(Flight::request()->data->getData());
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
    Flight::dish_service()->delete_dish($id);
    Flight::json('Dish has been deleted');
}, true);
