<?php

class EmployeeDao extends BaseDao{

  public $table = 'users';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
