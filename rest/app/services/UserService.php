<?php
class UserService {

    private $user_dao;

    public function __construct() {
        $this->user_dao = new UserDao();
    }

    public function login($user){
      $db_user = $this->get_user_by_email($user['user_email']);
      $is_admin = false;
      if($db_user){
        //UPDATE PASSWORD VERIFICATION
          if($db_user['password'] == $user['psword']){
      //if(password_verify($user['psword'], $db_user['password']) /*$db_user['password'] == $user['psword']*/){
          if($db_user['type_id'] == 3){
            $employee_dao = new EmployeeDao();
            $db_user_data = $employee_dao->get_by_id($db_user['id']);
          } else if($db_user['type_id'] == 2){
            $customer_dao = new CustomerDao();
            $db_user_data = $customer_dao->get_by_id($db_user['id']);
          } else if($db_user['type_id'] == 1){
            $admin_dao = new AdminDao();
            $db_user_data = $admin_dao->get_by_id($db_user['id']);
            $is_admin = true;
          }


          $token_data = [
            'id' => $db_user['id'],
            'email' => $db_user['email'],
            'name' => $db_user['name'],
            'is_admin' => $is_admin,
            'type_id' => $db_user['type_id']
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

    public function add_user($user){
      $user_id = $this->user_dao->add($user);
      return $user_id;
    }

    public function get_user_profile($id){
      $user = $this->user_dao->get_by_id($id)[0];
      return $user;
    }

    public function update_profile($user){
      $user['psword'] = password_hash($user['psword'], PASSWORD_DEFAULT);
      $this->user_dao->update_profile($user);
    }

}
