<?php

class UserDao extends BaseDao{

  public $table = 'students';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function get_user_by_email($user_email){
    return $this->execute_query("SELECT * FROM " . $this->table . " WHERE email = :email", [":email" => $user_email])[0];
  }
}

 ?>
