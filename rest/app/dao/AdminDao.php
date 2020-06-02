<?php

class AdminDao extends BaseDao{

  public $table = 'admin';

  public function __construct(){
    parent::__construct($this->table);
  }
}


 ?>
