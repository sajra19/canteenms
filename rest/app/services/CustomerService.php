<?php
class CustomerService {

    private $customer_dao;

    public function __construct() {
        $this->customer_dao = new CustomerDao();
    }


    public function get_customers($status){
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
      $customers = $this->customer_dao->get_all($status);

      foreach ($customers as $idx => $customer){

        if($customer['status'] == 1){
          $customers[$idx]['update_status'] = '<button class="btn btn-xs btn-outline red" onclick="Customers.update_status('.$customer['user_id'].',0)"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</button>';
        } else  {
          $customers[$idx]['update_status'] = '<button class="btn btn-xs btn-outline red" onclick="Customers.update_status('.$customer['user_id'].',1)"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Activate</button>';
        }

        $customers[$idx]['reset_password'] = '<button class="btn btn-xs btn-outline red" onclick="Customers.reset_password('.$customer['user_id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Reset Password</button>';
      }

      return  $customers;
    }

    public function update_status($id, $status){
      $this->customer_dao->update_status($id, $status);
    }

    public function register($customer){
      $user = [
        'name' => $customer['name'],
        'surname' => $customer['surname'],
        'phone'=> $customer['phone'],
        'email' => $customer['user_email'],
        'password' => $customer['psword'],
        'status' => 1,
        'type_id' => 1
      ];

      $user_dao = new UserDao();
      $user_id = $user_dao->add($user);

      $customer = [
        'user_id' =>$user_id,
        'registered_at' => date('d-m-Y', time())
      ];
    }
}
