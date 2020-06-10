<?php

class EmployeeDao extends BaseDao{

  public $table = 'employees';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
