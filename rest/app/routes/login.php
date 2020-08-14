<?php

/**
 *
 * @OA\Post(
 *     path="/login",
 *     tags={"login"},
 *     summary="Login",
 * )
 */
Flight::route('POST /login', function () {
  $user = Flight::request()->data->getData();
  Flight::user_service()->login($user);
});

/**
 *
 * @OA\Post(
 *     path="/register",
 *     tags={"register"},
 *     summary="Register",
 * )
 */
Flight::route('POST /register', function () {
  $user = Flight::request()->data->getData();
  $message = Flight::customer_service()->register($user);
  Flight::json($message);
});

/**
* @OA\Get(
*     path="/profile",
*     tags={"profile"},
*     summary="Get employee by its id",
*     description="Get employee by its id",
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
Flight::route('GET /profile', function () {
   $user = Flight::user_service()->get_user_profile(Flight::request()->query['id']);
   Flight::json($user);
}, true);

/**
 *
 * @OA\Post(
 *     path="/profile/edit",
 *     tags={"profile"},
 *     summary="Edit profile",
 * )
 */
Flight::route('POST /profile/edit', function ($route) {
    Flight::user_service()->update_profile(Flight::request()->data->getData());
    Flight::json('Profile has been updated');
}, true);
