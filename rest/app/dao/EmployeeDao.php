<?php

class EmployeeDao extends BaseDao{

  public $table = 'employees';

  public function __construct(){
    parent::__construct($this->table);
  }


    public function get_all($status){
      if(is_null($status)){
        return $this->execute_query("SELECT * FROM $this->table e JOIN user u ON e.user_id = u.id", []);
      } else {
        return $this->execute_query("SELECT * FROM $this->table e JOIN user u ON e.user_id = u.id AND u.status = :status", [':status' => $status]);
      }
    }

    public function update_employee_status($id){
      $this->execute([':id' => $id], " UPDATE $this->table SET status = 0 WHERE id = :id");
    }

    public function update_employee_item($employee){
      $this->execute([':fname' =>$employee['fname'], ':lname' =>$employee['lname'], ':user_email' => $employee['user_email'], ':phone' => $employee['phone'], ':id' => $employee['id']],
                     "UPDATE user SET name = :fname, surname = :lname, email = :user_email, phone = :phone WHERE id = :id");
    }

    public function update_status($id, $status){
      $this->execute([':id' => $id, ':status' => $status], " UPDATE user SET status = :status WHERE id = :id");
    }
}


 ?>
