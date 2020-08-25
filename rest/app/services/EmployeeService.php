<?php

//require 'dao/UserDao.php';
class EmployeeService {

    private $employee_dao;

    public function __construct() {
        $this->employee_dao = new EmployeeDao();
    }

    public function get_employees($status){
      switch ($status) {
        case 'active':
          $status = 1;
          break;
        case 'deleted':
          $status = 0;
          break;
        default:
          $status = null;
          break;
      }

      $employees = $this->employee_dao->get_all($status);

      foreach ($employees as $idx => $employee){
        if($employee['status'] == 1){
          $employees[$idx]['update_status'] = '<button class="btn btn-danger" onclick="Employee.update_status('.$employee['user_id'].',0)"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</button>';
        } else  {
          $employees[$idx]['update_status'] = '<button class="btn btn-success" onclick="Employee.update_status('.$employee['user_id'].',1)"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Activate</button>';
        }

        $employees[$idx]['edit_employee'] = '<button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="Employee.open_edit_modal('.$employee['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Edit</button>';

        $employees[$idx]['reset_password'] = '<button class="btn btn-secondary" onclick="Employee.reset_password('.$employee['user_id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Reset Password</button>';
      }


      return $employees;
    }

    public function get_by_user_id($id){
      return $this->employee_dao->get_by_user_id($id)[0];
    }

    public function update_status($id, $status){
      $this->employee_dao->update_status($id, $status);
    }

    public function update_employee_status($id){
      $this->employee_dao->update_employee_status($id);
    }

    public function delete_employee($employee_id){
      $this->employee_dao->delete_by_id((int)$employee_id);
    }

    public function add_employee($employee){
      $user_dao = new UserDao();
      $user = $user_dao->get_by_email($employee['email']);

      if(count($user) > 0){
        return 'Email is used';
      } else{
        $user = [
          'name' => $employee['name'],
          'surname' => $employee['surname'],
          'email' => $employee['email'],
          'password' => password_hash($employee['psword'], PASSWORD_DEFAULT), //$employee['password'],
          'phone' => $employee['phone'],
          'status' => 1,
          'type_id' => 2
        ];

        $user = $user_dao->add($user);

        $employee = [
          'user_id' => $user['id'],
          'contract_number' => 'test'.$user['id']
        ];
        $this->employee_dao->add($employee);

        return 'Employee has been added';
      }
    }

    public function update_employee($employee){
      $this->employee_dao->update_employee_item($employee);
    }


    public function reset_password($id){
      $rand = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
      $password = password_hash($rand, PASSWORD_DEFAULT);

      $user_dao = new UserDao();
      $user_dao->update_password($id, $password);
      return $rand;
    }



}
