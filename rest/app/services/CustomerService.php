<?php
class CustomerService {

    private $customer_dao;

    public function __construct() {
        $this->customer_dao = new CustomerDao();
    }


    public function get_customers(){
      $customers = $this->customer_dao->get_all();

      return  $customers;
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
