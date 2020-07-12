<?php
class OrdersService {

    private $orders_dao;

    public function __construct() {
        $this->orders_dao = new OrdersDao();
    }

    public function get_orders(){
      $orders = $this->orders_dao->get_all();
      foreach ($orders as $idx => $orders){
        $orders[$idx]['delete_orders'] = '<a class="btn btn-xs btn-outline red" onclick="Orders.delete_orders('.$orders['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
        $orders[$idx]['finish_orders'] = '<a class="btn btn-xs btn-outline red" onclick="Orders.finish_orders('.$orders['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Finish</a>';
      }
      
      return $orders;
    }

    public function delete_orders($orders_id){
      $this->orders_dao->delete_by_id((int)$orders_id);
    }

    public function add_orders($orders){
      $user = [
        //polje iz baze => polje iz forme
        'name' => $orders['name'],
        'amount' => $orders['amount'],
        'price' => $orders['price'],
        'type' => 'employee'
      ];

      $user_dao = new UserDao();
      $user_id = $user_dao->add_user($user);

      $user = [
        'user_id' => $user_id,
        'name' => $orders['name'],
        'surname' => $orders['surname']
      ];

      $this->orders_dao->add($orders);
    }


    }
