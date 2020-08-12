<?php

class EmployeeDao extends BaseDao{

  public $table = 'user';

  public function __construct(){
    parent::__construct($this->table);
  }


    public function get_employees(){
      return $this->execute_query("SELECT * FROM " . $this->table . " WHERE status = 1", []);
    }

    public function update_employee_status($id){
      $this->execute([':id' => $id], " UPDATE $this->table SET status = 0 WHERE id = :id");
    }

    public function update_employee_item($menu){
      $this->execute([':name' =>$employee['fname'], ':surname' =>$employee['lname'], ':email' => $employee['user_email'], ':phone' => $employee['phone'], ':password' =>$employee['psword'], ':id' => $employee['id']],
                     "UPDATE $this->table SET name = :fname, surname = :lname, email = :user_email, phone = :phone, password = :psword WHERE id = :id");
    }
}


 ?>
