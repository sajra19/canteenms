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
