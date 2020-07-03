<?php

class DishesDao extends BaseDao{

  public $table = 'dishes';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
