<?php
    class CartService {

        private $cart_dao;

        public function __construct() {
            $this->cart_dao = new CartDao();
        }

        public function add_to_cart($cart){
          $this->cart_dao->add($cart);
        }

        public function get_customer_cart($customer_id){
          $dish_dao = new DishesDao();
          $carts = $this->cart_dao->get_by_user_id($customer_id);
          $total = 0;
          foreach ($carts as $idx => $cart){
            $dish = $dish_dao->get_by_id($cart['dish_id'])[0];
            $carts[$idx]['dish_name'] = $dish['name'];
            $carts[$idx]['price'] = $dish['price'] * $cart['amount'];
            $carts[$idx]['plus'] = '<button class="btn btn-xs btn-outline red" onclick="Cart.update_amount ('.$cart['id'].', \''."I".'\')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Add</button>';
            $carts[$idx]['minus'] = '<button class="btn btn-xs btn-outline red" onclick="Cart.update_amount ('.$cart['id'].', \''."D".'\')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Remove</button>';
            $total += $carts[$idx]['price'];
          }

          return [
            'cart' => $carts,
            'total' => $total
          ];
        }

        public function update_amount($id, $type){
          $cart = $this->cart_dao->get_by_id($id)[0];
          if($type == "I"){
            $cart['amount'] = $cart['amount'] + 1;
          }else{
              $cart['amount'] = $cart['amount'] - 1;
          }

          $this->cart_dao->update_amount($id, $cart['amount']);

          $cart = [
            'message' => 'Cart updated successfully',
            'data' => null
          ];

          return $cart;

        }

        public function update_cart_status($customer_id, $status){
          $this->cart_dao->update_cart_status($customer_id, $status);
        }

        public function update_cart_dish_status($id, $status){
          $this->cart_dao->update_cart_dish_status($id, $status);
        }
    }
