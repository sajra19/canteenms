<?php

class CustomerDao extends BaseDao{

  public $table = 'customer';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
