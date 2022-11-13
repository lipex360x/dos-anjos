<?php
require_once plugin_dir_path(__FILE__) . '../entities/index.php';

class EmployeeAddressRepository {
  function __construct() {
    $this->entity = new EmployeeAddress();
    $this->tableName = $this->entity->tableName();
  }
  
  function create($data) {
    global $wpdb;
    $wpdb->show_errors();

    $data['id'] = wp_generate_uuid4();
    $this->tableName;

    $commit = $wpdb->insert($this->tableName, $data);
    $commitError = $wpdb->last_error;

    $query = "SELECT * FROM {$this->tableName} ORDER BY created_at DESC";
    $getData = $wpdb->get_row($query);

    if($commit) {
      $response = [
        'code' => 200,
        'message' => 'created',
        'data' => $getData
      ];
    } else {
      $response = [
        'code' => 400,
        'message' => $commitError,
        'data' => null
      ];
    }

    return $response;
  }

  function list() {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName}";

    return $wpdb->get_results($query);
  }

  function show($id) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE id = '{$id}'";
    
    return $wpdb->get_row($query);
  }

  function update($id, $updateData) {
    global $wpdb;
    $wpdb->show_errors();

    $commit = $wpdb->update($this->tableName, $updateData, array('id' => $id));
    $commitError = $wpdb->last_error;

    $query = "SELECT * FROM {$this->tableName} ORDER BY created_at DESC";
    $getData = $wpdb->get_row($query);
    
    if($commit) {
      $response = [
        'code' => 200,
        'message' => 'updated',
        'data' => $this->show($id)
      ];
    } else {
      $response = [
        'code' => 200,
        'message' => $commitError,
        'data' => null
      ];
    }

    return $response;
  }

  function delete($id) {
    global $wpdb;
    $wpdb->show_errors();

    $query = "SELECT * FROM {$this->tableName} WHERE id = '{$id}'";
    $deletedRow = $wpdb->get_row($query);

    $commit = $wpdb->delete($this->tableName, array('id' => $id));
    $commitError = $wpdb->last_error;

    if($commit) {
      $response = [
        'code' => 200,
        'message' => 'removed',
        'data' => $deletedRow
      ];
    } else {
      $response = [
        'code' => 200,
        'message' => $commitError,
        'data' => null
      ];
    }

    return $response;
  }

  function findByEmployeeId($employee_id) {
    global $wpdb;

    $query = "SELECT * FROM {$this->tableName} WHERE employee_id = '{$employee_id}'";
    
    return $wpdb->get_row($query);
  }

  function getSchema() {
    global $wpdb;

    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$this->tableName}'";
    $data = $wpdb->get_results($query);
    
    $schema = array();
    foreach ($data as $key => $value) {
      if (
        $value->COLUMN_NAME === 'id' || 
        $value->COLUMN_NAME === 'created_by' ||
        $value->COLUMN_NAME === 'created_at' ||
        $value->COLUMN_NAME === 'updated_at' ||
        $value->COLUMN_NAME === 'deleted_at'
      ) continue;

      array_push($schema, $value->COLUMN_NAME);
    }

    return $schema;
  }
}