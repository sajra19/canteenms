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
        $employees[$idx]['edit_employee'] = '<button class="btn btn-xs btn-outline red" data-toggle="modal" data-target="#editModal" onclick="Employee.open_edit_modal('.$employee['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Edit</button>';
      }

      return $employees;
    }

    public function get_employee_by_id($id){
      return $this->employee_dao->get_by_id($id)[0];
    }

    public function update_employee_status($id){
      $this->employee_dao->update_employee_status($id);
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

      $this->employee_dao->add($employee);
    }


        public function update_employee($employee){
          $this->employee_dao->update_emmployee_item($employee);
        }


}
