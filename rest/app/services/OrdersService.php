<?php
class OrdersService {

    private $cart_dao;

    public function __construct() {
        $this->cart_dao = new CartDao();
    }

    public function get_orders(){
      $orders = $this->cart_dao->get_orders();
      $dish_dao = new DishesDao();
      foreach ($orders as $idx => $order){
        $dish = $dish_dao->get_by_id($order['dish_id'])[0];
        $orders[$idx]['dish_name'] = $dish['name'];
        $orders[$idx]['price'] = $dish['price'] * $order['amount'];
        $orders[$idx]['reject'] = '<button class="btn btn-danger" onclick="Cart.update_cart_dish_status('.$order['id'].', \''."REJECTED".'\')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</button>';
        $orders[$idx]['ready'] = '<button class="btn btn-secondary" onclick="Cart.update_cart_dish_status('.$order['id'].', \''."READY".'\')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Ready</button>';
        $orders[$idx]['finish'] = '<button class="btn btn-success" onclick="Cart.update_cart_dish_status('.$order['id'].', \''."FINISHED".'\')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Finish</button>';
      }

      return $orders;
    }

    public function delete_orders($orders_id){
      $this->cart_dao->delete_by_id((int)$orders_id);
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

      $this->cart_dao->add($orders);
    }


    }
