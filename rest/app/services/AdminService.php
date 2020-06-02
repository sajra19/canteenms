<?php
class AdminService {

    private $admin_dao;

    public function __construct() {
        $this->admin_dao = new AdminDao();
    }

    public function get_admin(){
      $admin = $this->admin_dao->get_all();
      foreach ($admin as $idx => $admin){
        $admin[$idx]['delete_admin'] = '<a class="btn btn-xs btn-outline red" onclick="Admin.delete_admin('.$admin['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
      }

      return $admin;
    }

    public function delete_admin($admin_id){
      $this->admin_dao->delete_by_id((int)$admin_id);
    }

    public function add_admin($admin){
      $admin = [
        'name' => $admin['name'],
        'surname' => $admin['surname'],
        'email' => $admin['user_email'],
        'password' => password_hash($admin['password'], PASSWORD_DEFAULT)
      ];

      $this->admin_dao->add($admin);
    }


}
