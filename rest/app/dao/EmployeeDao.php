<?php

class EmployeeDao extends BaseDao{

  public $table = 'students';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
