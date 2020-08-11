<?php

/**
* @OA\Get(
*     path="/menu",
*     tags={"menu"},
*     summary="Get list of all menu items",
*     description="Get list of all menu items",
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
* @OA\Get(
*     path="/menu/id",
*     tags={"menu"},
*     summary="Get menu by its id",
*     description="Get menu by its id",
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
Flight::route('GET /menu/id', function () {
   $menu = Flight::menu_service()->get_menu_by_id(Flight::request()->query['id']);
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
 * @OA\Post(
 *     path="/menu/edit",
 *     tags={"menu"},
 *     summary="Edit menu item",
 * )
 */
Flight::route('POST /menu/edit', function ($route) {
    Flight::menu_service()->update_menu(Flight::request()->data->getData());
    Flight::json('Menu item has been updated');
}, true);


/**
 *
 * @OA\Patch(
 *     path="/menu/{id}/status",
 *     tags={"menu"},
 *     summary="Delete menu item",
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
Flight::route('PATCH /menu/@id/status', function ($id, $route) {

    $menu = Flight::menu_service()->update_status($id);
    Flight::json($menu);
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
