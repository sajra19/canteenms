<?php
class AdminService {

    private $admin_dao;

    public function __construct() {
        $this->admin_dao = new UserDao();
    }

    public function get_admins($status){
      switch ($status) {
        case 'active':
          $status = 1;
          break;
        case 'deleted':
          $status = 0;
          break;
        default:
          $status = null;
          break;
      }

      $admins = $this->admin_dao->get_all_admin_users($status);

      foreach ($admins as $idx => $admin){
        if($admin['status'] == 1){
          $admins[$idx]['update_status'] = '<button class="btn btn-xs btn-outline red" onclick="Admin.update_status('.$admin['id'].',0)"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</button>';
        } else  {
          $admins[$idx]['update_status'] = '<button class="btn btn-xs btn-outline red" onclick="Admin.update_status('.$admin['id'].',1)"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Activate</button>';
        }
      }

      return $admins;
    }

    public function delete_admin($admin_id){
      $this->admin_dao->delete_by_id((int)$admin_id);
    }

    public function update_status($id, $status){
      $this->admin_dao->update_status($id, $status);
    }

    public function add_admin($admin){
      $user = $this->admin_dao->get_by_email($admin['email']);

      if(count($user) > 0){
        return 'Email is used';
      } else{
        $user = [
          'name' => $admin['name'],
          'surname' => $admin['surname'],
          'email' => $admin['email'],
          'password' => password_hash($admin['psword'], PASSWORD_DEFAULT), //$admin['password'],
          'phone' => $admin['phone'],
          'status' => 1,
          'type_id' => 1
        ];

        $user = $this->admin_dao->add($user);

        return 'Admin has been added';
      }
    }


}
