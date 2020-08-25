<?php
class MenuService {

    private $menu_dao;

    public function __construct() {
        $this->menu_dao = new MenuDao();
    }

    public function get_menu(){
      $menus = $this->menu_dao->get_menu();
      foreach ($menus as $idx => $menu){
        $menus[$idx]['delete_menu'] = '<a class="btn btn-danger" onclick="Menu.delete_menu('.$menu['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
        $menus[$idx]['edit_menu'] = '<button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="Menu.open_edit_modal('.$menu['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Edit</button>';
      }

      return $menus;
    }

    public function get_menu_by_id($id){
      return $this->menu_dao->get_by_id($id)[0];
    }

    public function update_status($id){
      $this->menu_dao->update_status($id);
    }

    public function delete_menu($menu_id){
      $this->menu_dao->delete_by_id((int)$menu_id);
    }

    public function add_menu($menu){
      $menu = [
        //polje iz baze => polje iz forme
        'name' => $menu['name'],
        'price' => $menu['price'],
        'description' => $menu['description'],
        'status' => 1
      ];

      $this->menu_dao->add($menu);
    }

    public function update_menu($menu){
      $this->menu_dao->update_menu_item($menu);
    }
}
