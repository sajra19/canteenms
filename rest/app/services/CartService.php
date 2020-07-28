<?php
    class CartService {

        private $cart_dao;

        public function __construct() {
            $this->cart_dao = new CartDao();
        }

        public function add_to_cart($cart){
          $this->dish_dao->add($cart);
        }

        public function get_customer_cart($customer_id){
          $dish_dao = new DishesDao();
          $carts = $this->$cart_dao->get_by_user_id($customer_id);
          foreach ($carts as $idx => $cart){
            $dish = $dish_dao->get_by_id($cart['dish_id'])[0];
            $carts[$idx]['dish_name'] = $dish['name'];
            $carts[$idx]['price'] = $dish['price'];
            $carts[$idx]['plus'] = '<a class="btn btn-xs btn-outline red" onclick="Carts.update_amount('.$cart['id'].', "I")"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Add</a>';
            $carts[$idx]['minus'] = '<a class="btn btn-xs btn-outline red" onclick="Carts.update_amount('.$cart['id'].', "D")"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Remove</a>';
          }

          return $carts;
        }

        public function update_amount($id, $type){
          $cart = $this->cart_dao->get_by_id($id)[0];
          if($type == 'I'){
            $cart['amount'] = $cart['amount'] + 1;
          }else{
              $cart['amount'] = $cart['amount'] - 1;
          }

          $this->cart_dao->update_amount($id, $cart['amount']);
        }

        public function update_cart_status($customer_id, $status){
          $this->cart_dao->update_status($customer_id, $status);
        }

        public function update_cart_dish_status($ids, $status){
          $this->cart_dao->update_cart_dish_status($id, $status);
        }



    }
