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

    public function reset_password($id){
      $rand = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
      $password = password_hash($rand, PASSWORD_DEFAULT);

      $user_dao = new UserDao();
      $user_dao->update_password($id, $password);
      return $rand;
    }

    public function register($customer){
      $user_dao = new UserDao();
      $user = $user_dao->get_by_email($customer['email']);

      if(count($user) > 0){
        return 'Email is used';
      } else{
        $user = [
          'name' => $customer['name'],
          'surname' => $customer['surname'],
          'phone'=> $customer['phone'],
          'email' => $customer['user_email'],
          'password' => password_hash($customer['psword'], PASSWORD_DEFAULT),//$customer['psword'],
          'status' => 1,
          'type_id' => 1
        ];

        $user = $user_dao->add($user);

        $customer = [
          'user_id' => $user['id'],
          'created_at' => date('d-m-Y', time())
        ];

        $this->customer_dao->add($customer);

        return 'Account has been created';
      }
    }
}
