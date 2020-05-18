<?php
class UserService {

    private $user_dao;

    public function __construct() {
        $this->user_dao = new UserDao();
    }

    public function login($user){
      $db_user = $this->get_user_by_email($user['user_email']);

      if($db_user){
        //UPDATE PASSWORD VERIFICATION
        if($db_user['password'] == $user['psword']){
          $token_data = [
            'id' => $db_user['id'],
            'email' => $db_user['email'],
            'name' => $db_user['name'],
            'is_admin' => false
          ];

          $jwt = Auth::encode_jwt($token_data);
          Flight::json(['user_token' => $jwt]);
        } else {
          Flight::halt(404, 'Password is not correct');
        }
      } else {
        Flight::halt(404, 'User not found');
      }
    }

    public function get_user_by_email($user_email){
      $user = $this->user_dao->get_user_by_email($user_email);
      return $user;
    }


}
