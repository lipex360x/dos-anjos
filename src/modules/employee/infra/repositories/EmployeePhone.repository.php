<?php
require_once plugin_dir_path(__FILE__) . '../entities/index.php';

class EmployeePhoneRepository extends BaseRepository {
  function __construct() {
    $this->entity = new EmployeePhone();
    $this->tableName = $this->entity->tableName();
  }
  
  function findByEmployeeId($employee_id) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE employee_id = '{$employee_id}'";
    
    return $wpdb->get_results($query);
  }
}