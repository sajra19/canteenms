<?php

class UserDao extends BaseDao{

  public $table = 'user';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function get_user_by_email($profile_email){
    return $this->execute_query("SELECT * FROM " . $this->table . " WHERE email = :email", [":email" => $profile_email])[0];
  }

  public function get_all_admin_users($status){
    if(is_null($status)){
      return $this->execute_query("SELECT * FROM $this->table WHERE type_id = 1", []);
    } else {
      return $this->execute_query("SELECT * FROM $this->table WHERE status = :status AND type_id = 1", [':status' => $status]);
    }
  }

  public function update_status($id, $status){
    $this->execute([':id' => $id, ':status' => $status], " UPDATE user SET status = :status WHERE id = :id");
  }

  public function update_profile($profile){
    $this->execute([':fname' =>$profile['fname'], ':lname' =>$profile['lname'], ':user_email' => $profile['user_email'], ':phone' => $profile['phone'], ':password' => $profile['psword'], ':id' => $profile['id']],
                   "UPDATE $this->table SET name = :fname, surname = :lname, email = :user_email, phone = :phone,  password = :password WHERE id = :id");
  }
}

 ?>
