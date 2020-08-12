<?php

/**
* @OA\Get(
*     path="/customers",
*     tags={"customers"},
*     summary="Get list of all customers",
*     description="Get list of all customers",
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route('GET /customers', function ($route) {
  //  $user_data = Auth::decode_jwt_admin($route);
    $customers = Flight::customers_service()->get_customers();
    Flight::json($dishes);
}, true);
