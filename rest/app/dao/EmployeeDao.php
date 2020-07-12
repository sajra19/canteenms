<?php

class EmployeeDao extends BaseDao{

  public $table = 'user';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
