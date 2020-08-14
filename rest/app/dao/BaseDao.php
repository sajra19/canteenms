<?php

class BaseDao{
  private $pdo;

  private $table_name;

  public function __construct($table_name){
    $this->pdo = new PDO('mysql:host=remotemysql.com;dbname=tEYQ0vL2Rn','tEYQ0vL2Rn','Xwqg1jEEB0');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->table_name = $table_name;
  }

  protected function execute_query($sql_query, $params){
    $stmt = $this->pdo->prepare($sql_query);
    $stmt->execute($params);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

  public function get_all(){
    return $this->execute_query("SELECT * FROM {$this->table_name}", []);
  }

  public function get_by_id($id){
    return $this->execute_query("SELECT * FROM {$this->table_name} WHERE id = :id", ["id" => $id]);
  }

  public function get_by_email($email){
    return $this->execute_query("SELECT * FROM {$this->table_name} WHERE email = :email", [":email" => $email]);
  }

  public function get_by_user_id($user_id){
     return $this->execute_query("SELECT * FROM {$this->table_name} t JOIN user u ON t.user_id = u.id WHERE t.user_id = :user_id", [":user_id" => $user_id]);
  }

  protected function execute_insert($entity){
    $columns = "";
    $params = "";
    foreach ($entity as $key => $value) {
      $columns .= $key.",";
      $params .=":".$key.",";
    }
    $columns = rtrim($columns, ",");
    $params = rtrim($params, ",");

    $stmt = $this->pdo->prepare("INSERT INTO {$this->table_name} ({$columns}) VALUES ({$params})");
    $stmt->execute($entity);
    $entity['id'] = $this->pdo->lastInsertId();
    return $entity;
  }

  public function add($entity){
    return $this->execute_insert($entity);
  }

  public function execute($entity, $query){
    try {
      $stmt = $this->pdo->prepare($query);
      if ($entity){
        foreach($entity as $key => $value){
          $stmt->bindValue($key, $value);
        }
      }
      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function update($entity, $query){
    $this->execute($entity, $query);
  }

  public function update_password($id, $password){
    $this->execute([':id' => $id, ':password' => $password], "UPDATE {$this->table_name} SET password = :password WHERE id = :id");
  }

  public function delete_by_id($id){
    $this->execute([':id' => $id], "UPDATE {$this->table_name} SET status = 'DELETED' WHERE id = :id");
  }



}

 ?>
