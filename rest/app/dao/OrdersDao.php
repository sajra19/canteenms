<?php

class OrdersDao extends BaseDao{

  public $table = 'orders';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
