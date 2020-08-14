<?php

class CustomerDao extends BaseDao{

  public $table = 'customer';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function get_all($status){
    if(is_null($status)){
      return $this->execute_query("SELECT * FROM $this->table c JOIN user u ON c.user_id = u.id", []);
    } else {
      return $this->execute_query("SELECT * FROM $this->table c JOIN user u ON c.user_id = u.id AND u.status = :status", [':status' => $status]);
    }
  }

  public function update_status($id, $status){
    $this->execute([':id' => $id, ':status' => $status], " UPDATE user SET status = :status WHERE id = :id");
  }
}


 ?>
