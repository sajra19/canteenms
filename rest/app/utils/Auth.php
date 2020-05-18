<?php
use \Firebase\JWT\JWT;


class Auth {
  public function encode_jwt($token_data){
    $user_token = [
      'iat' => time(),
      'exp' => strtotime(JWT_TOKEN_VALIDITY),
      'data' => $token_data
    ];

    $jwt = JWT::encode($user_token, JWT_KEY);

    return $jwt;
  }

  public function decode_jwt($data){
    try{
      $jwt = explode("Bearer ", $data['authorization'])[1];

      $user_data = (array) JWT::decode($jwt, JWT_KEY, ['HS256']);

      if($user_data){
        $user_data['data'] = (array) $user_data['data'];

        return $user_data;
      }
    } catch (\Throwable $e) {
       Flight::halt(403, "Invalid token! Error: " . $e->getMessage());
    }
  }

  public function decode_jwt_admin($data){
    try{
      $jwt = explode("Bearer ", $data['authorization'])[1];

      $user_data = (array) JWT::decode($jwt, JWT_KEY, ['HS256']);

      if($user_data){
        $user_data['data'] = (array) $user_data['data'];

        if(!$user_data['data']['is_admin']){
          Flight::halt(403, "It is allowed only for admin");
        }

        return $user_data;
      }
    } catch (\Throwable $e) {
       Flight::halt(403, "Invalid token! Error: " . $e->getMessage());
    }
  }

}

 ?>
