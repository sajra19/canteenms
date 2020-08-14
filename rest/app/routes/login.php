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
