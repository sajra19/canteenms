<?php

//require 'dao/UserDao.php';
class EmployeeService {

    private $employee_dao;

    public function __construct() {
        $this->employee_dao = new EmployeeDao();
    }

    public function get_employees(){
      $employees = $this->employee_dao->get_all();

      foreach ($employees as $idx => $employee){
        $employees[$idx]['delete_employee'] = '<a class="btn btn-xs btn-outline red" onclick="Employee.delete_employee('.$employee['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
        $employees[$idx]['edit_employee'] = '<a class="btn btn-xs btn-outline red" onclick="Employee.edit_employee('.$employee['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
      }

      return $employees;
    }

    public function delete_employee($employee_id){
      $this->employee_dao->delete_by_id((int)$employee_id);
    }

    public function add_employee($employee){
      $user = [
        'name' => $employee['name'],
        'surname' => $employee['surname'],
        'email' => $employee['email'],
        'password' => $employee['password'],
        'phone' => $employee['phone'],
        'status' => 1,
        'type' => 2
      ];

      $user_dao = new UserDao();
      $user_id = $user_dao->add_user($user);

      $employee = [
        'user_id' => $user_id,
        'name' => $employee['name'],
        'surname' => $employee['surname'],
      ];

      $this->employee_dao->add($employee);
    }


}
