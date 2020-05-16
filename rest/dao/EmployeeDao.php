<?php
require_once 'BaseDao.php';

class EmployeeDao extends BaseDao{

    public $table = 'employee';

  public function __construct(){
    parent::__construct();
  }

  public function update_employee($employee, $employee_id){
    $entity[':id'] = $employee_id;
    $query= 'UPDATE '.  $this->table . ' SET ';
    foreach ($employee as $key => $value) {
      $query .= $key . '=:' . $key . ', ';
      $entity[':' . $key] = $value;
    }
    $query = rtrim($query,', ') . ' WHERE id=:id';
    return $this->update($entity, $query);
  }

  public function delete_employee($employee_id){
    $entity[':id'] = $employee_id;
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    return $this->execute($entity, $query);
  }

  public function remove_employee($employee_id){
    $this->execute([':employee_id' => $employee_id], 'UPDATE ' . $this->table . ' SET status = 0 WHERE id = :student_id');
  }


}


 ?>
