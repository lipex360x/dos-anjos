<?php
require_once plugin_dir_path(__FILE__) . '../entities/index.php';

class EmployeeRepository extends BaseRepository {
  function __construct() {
    $this->entity = new Employee();
    $this->tableName = $this->entity->tableName();
  }

  function findByCpf($cpf) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE cpf = '{$cpf}'";
    
    return $wpdb->get_row($query);
  }

  function list() {
    global $wpdb;

    $query  = "SELECT * FROM {$this->tableName}";
  
    return $wpdb->get_results($query);
  }
}