<?php

/**
* @OA\Get(
*     path="/menu",
*     tags={"menu"},
*     summary="Get list of all menu",
*     description="Get list of all menu",
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /menu', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $menu = Flight::menu_service()->get_menu();
    Flight::json($menu);
}, true);

/**
 *
 * @OA\Post(
 *     path="/menu",
 *     tags={"menu"},
 *     summary="Add new menu",
 * )
 */
Flight::route('POST /menu', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::menu_service()->add_menu(Flight::request()->data->getData());
    Flight::json('Menu item has been added');
}, true);

/**
 *
 * @OA\Delete(
 *     path="/menu/{id}",
 *     tags={"menu"},
 *     summary="Delete menu",
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
Flight::route("DELETE /menu/@id", function ($id, $route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    Flight::menu_service()->delete_menu($id);
    Flight::json('Menu item has been deleted');
}, true);
