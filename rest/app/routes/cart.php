<?php
/**
 *
 * @OA\Post(
 *     path="/dish_to_cart",
 *     tags={"cart"},
 *     summary="Add dish to cart",
 * )
 */
Flight::route('POST /dish_to_cart', function ($route) {
    //$user_data = Auth::decode_jwt_admin($route);
    Flight::cart_service()->add_to_cart(Flight::request()->data->getData());
    Flight::json('Dish has been added');
}, true);

/**
* @OA\Get(
*     path="/cart",
*     tags={"cart"},
*     summary="Get list of all employees",
*     description="Get list of all employees",
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /cart', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $customer_id = Flight::request()->query['id'];
    $cart = Flight::cart_service()->get_customer_cart($customer_id);
    Flight::json($cart);
}, true);


/**
 *
 * @OA\Patch(
 *     path="/cart/{id}/amount",
 *     tags={"cart"},
 *     summary="Update cart amount",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="type",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 * )
 */
Flight::route('PATCH /cart/@id/amount', function ($id, $route) {

    $cart = Flight::cart_service()->update_amount($id, Flight::request()->query['type']);
    Flight::json($cart);
}, true);

/**
 *
 * @OA\Patch(
 *     path="/cart/{customer_id}/status",
 *     tags={"cart"},
 *     summary="Checkout",
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
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 * )
 */
Flight::route('PATCH /cart/@customer_id/status', function ($customer_id, $route) {

    $cart = Flight::cart_service()->checkout($customer_id, Flight::request()->query['status']);
    Flight::json($cart);
}, true);

/**
 *
 * @OA\Patch(
 *     path="/cart/{id}/status",
 *     tags={"cart"},
 *     summary="Update cart dish by employee or admin",
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
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 * )
 */
Flight::route('PATCH /cart/@id/status', function ($id, $route) {

    $cart = Flight::cart_service()->update_cart_dish_status($id, Flight::request()->query['status']);
    Flight::json($cart);
}, true);
