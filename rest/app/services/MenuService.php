<?php
class MenuService {

    private $menu_dao;

    public function __construct() {
        $this->menu_dao = new MenuDao();
    }

    public function get_menu(){
      $menu = $this->menu_dao->get_all();
      foreach ($menu as $idx => $menu){
        $menu[$idx]['delete_menu'] = '<a class="btn btn-xs btn-outline red" onclick="Menu.delete_menu('.$menu['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
        $menu[$idx]['finish_menu'] = '<a class="btn btn-xs btn-outline red" onclick="Menu.finish_menu('.$menu['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Finish</a>';
      }

      return $menu;
    }

    public function delete_menu($menu_id){
      $this->menu_dao->delete_by_id((int)$menu_id);
    }

    public function add_menu($menu){
      $user = [
        //polje iz baze => polje iz forme
        'name' => $menu['name'],
        'price' => $menu['price'],
        'description' => $menu['description'],
        'status' => $menu['status'],
        'type' => 'admin'
      ];

      $user_dao = new UserDao();
      $user_id = $user_dao->add_user($user);

      $employee = [
        'user_id' => $user_id,
        'name' => $employee['name'],
        'surname' => $employee['surname']
      ];

      $this->employee_dao->add($employee);
    }


    }
