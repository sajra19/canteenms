<?php

/**
* @OA\Get(
*     path="/customers",
*     tags={"customers"},
*     summary="Get list of all customers",
*     description="Get list of all customers",
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
Flight::route('GET /customers', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $customers = Flight::customer_service()->get_customers(Flight::request()->query['status']);
    Flight::json($customers);
}, true);

/**
 *
 * @OA\Patch(
 *     path="/customer/{id}/status",
 *     tags={"customer"},
 *     summary="Update customer status",
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
Flight::route('PATCH /customer/@id/status', function ($id, $route) {

    $customer = Flight::customer_service()->update_status($id, Flight::request()->query['status']);
    Flight::json($customer);
}, true);
