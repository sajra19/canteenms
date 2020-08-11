<?php

class MenuDao extends BaseDao{

  public $table = 'dishes';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function get_menu(){
    return $this->execute_query("SELECT * FROM " . $this->table . " WHERE status = 1", []);
  }

  public function update_status($id){
    $this->execute([':id' => $id], " UPDATE $this->table SET status = 0 WHERE id = :id");
  }

  public function update_menu_item($menu){
    $this->execute([':name' =>$menu['name'], ':price' => $menu['price'], ':description' => $menu['description'], ':id' => $menu['id']],
                   "UPDATE $this->table SET name = :name, description = :description, price = :price WHERE id = :id");
  }
}


 ?>
